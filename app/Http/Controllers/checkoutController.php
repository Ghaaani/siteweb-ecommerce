<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\product_category;
use App\Models\cart_item;
use App\Models\checkout;
use App\Models\order_item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\PaymentIntent;

class checkoutController extends Controller
{
    /**
     * Display the checkout page (cart + billing + payment method).
     */
    public function index()
    {
        $categories = product_category::All();
        $cart = cartController::cartTotal();

        if (request()->expectsJson()) {
            return response()->json(['cart' => $cart]);
        }

        return view('checkout', compact('categories', 'cart'));
    }

    /**
     * Display a single checkout/order.
     */
    public function show($id)
    {
        $checkout = checkout::with('orderItems')->find($id);

        if (!$checkout) {
            return redirect('/checkout');
        }

        return view('checkout', compact('checkout'));
    }

    /**
     * Place the order from the cart and move the customer to payment.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:120',
            'phone' => 'nullable|string|max:40',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:120',
            'country' => 'nullable|string|max:120',
            'payment_method' => 'required|in:card,paypal',
        ]);

        $cart = cartController::cartTotal();

        if ($cart['items']->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Your cart is empty'], 422);
        }

        $checkout = checkout::create([
            'user_id' => $request->user()?->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'city' => $validated['city'] ?? null,
            'country' => $validated['country'] ?? null,
            'payment_method' => $validated['payment_method'],
            'payment_status' => 'pending',
            'subtotal' => $cart['subtotal'],
            'shipping' => 0,
            'total' => $cart['total'],
            'status' => checkout::STATUS_PENDING,
        ]);

        foreach ($cart['items'] as $item) {
            order_item::create([
                'checkout_id' => $checkout->id,
                'product_id' => $item->product_id,
                'name' => $item->name,
                'prix' => $item->prix,
                'quantity' => $item->quantity,
            ]);
        }

        // Empty the cart after a successful order placement.
        cart_item::query()->delete();

        if ($validated['payment_method'] === 'paypal') {
            $paypalOrder = $this->createPaypalOrder($checkout);

            return response()->json([
                'success' => true,
                'payment_method' => 'paypal',
                'paypal_order_id' => $paypalOrder['id'] ?? null,
                'checkout_id' => $checkout->id,
                'redirect_url' => $paypalOrder['approve_link'] ?? null,
                'total' => $checkout->total,
            ]);
        }

        // Card payment: create a Stripe PaymentIntent for the remaining amount.
        $paymentIntent = $this->createCardPayment($checkout);

        return response()->json([
            'success' => true,
            'payment_method' => 'card',
            'payment_intent_client_secret' => $paymentIntent ? $paymentIntent->client_secret : null,
            'checkout_id' => $checkout->id,
            'total' => $checkout->total,
        ]);
    }

    /**
     * Display the payment step for a checkout.
     */
    public function payment($id)
    {
        $checkout = checkout::with('orderItems')->find($id);
        $cart = $checkout ? [
            'items' => $checkout->orderItems,
            'subtotal' => (float) $checkout->subtotal,
            'shipping' => (float) $checkout->shipping,
            'total' => (float) $checkout->total,
        ] : cartController::cartTotal();

        $categories = product_category::All();

        if ($checkout) {
            return view('checkout', compact('checkout', 'cart', 'categories'));
        }

        return redirect('/checkout');
    }

    /**
     * Create a Stripe PaymentIntent for the given checkout.
     */
    public function createCardPayment(checkout $checkout)
    {
        if (!str_starts_with((string) config('services.stripe.key'), 'sk_')) {
            // Sandbox mode: no Stripe key configured -> simulate the card payment.
            $checkout->update([
                'payment_status' => checkout::STATUS_PAID,
                'status' => checkout::STATUS_PAID,
            ]);

            return null;
        }

        $paymentIntent = PaymentIntent::create([
            'amount' => (int) round($checkout->total * 100),
            'currency' => 'usd',
            'payment_method_types' => ['card'],
            'payment_option' => 'manual',
            'confirm' => false,
            'metadata' => [
                'checkout_id' => $checkout->id,
            ],
        ]);

        return $paymentIntent;
    }

    /**
     * Create a PayPal Checkout order for the given checkout.
     */
    public function createPaypalOrder(checkout $checkout)
    {
        $clientId = config('services.paypal.client_id');
        $clientSecret = config('services.paypal.client_secret');
        $mode = config('services.paypal.mode', 'sandbox');

        if (!$clientId || !$clientSecret) {
            // Sandbox/demo mode: no PayPal credentials configured -> simulate approval.
            return [
                'id' => 'PAYPAL-SANDBOX-' . $checkout->id,
                'approve_link' => route('paypal.return', ['token' => 'SANDBOX-' . $checkout->id, 'checkout_id' => $checkout->id]),
                'sandbox' => true,
            ];
        }

        $auth = base64_encode($clientId . ':' . $clientSecret);
        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'Authorization' => 'Basic ' . $auth,
            'Content-Type' => 'application/json',
        ])->post('https://api-m.' . $mode . '.paypal.com/v2/checkout/orders', [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => (string) $checkout->total,
                    ],
                ],
            ],
            'application_context' => [
                'brand_name' => config('app.name'),
                'return_url' => route('paypal.return', ['checkout_id' => $checkout->id]),
                'cancel_url' => route('checkout.payment', ['id' => $checkout->id]),
            ],
        ]);

        if ($response->failed()) {
            return null;
        }

        $order = $response->json();
        $approveLink = collect($order['links'] ?? [])->pluck('href')->first();

        return [
            'id' => $order['id'] ?? null,
            'approve_link' => $approveLink,
            'sandbox' => $mode === 'sandbox',
        ];
    }

    /**
     * PayPal redirect return/capture handler.
     */
    public function paypalReturn(Request $request)
    {
        $token = $request->query('token');
        $checkoutId = $request->query('checkout_id');

        if ($token) {
            $checkout = checkout::find($checkoutId);

            if ($checkout) {
                // Capture the approved PayPal order when real credentials are configured.
                $this->capturePaypalOrder($token, $checkout);

                $checkout->update([
                    'payment_status' => checkout::STATUS_PAID,
                    'status' => checkout::STATUS_PAID,
                ]);
            }
        }

        return redirect()->route('checkout.success', ['id' => $checkoutId]);
    }

    /**
     * Capture an approved PayPal order.
     */
    protected function capturePaypalOrder($orderId, checkout $checkout)
    {
        $clientId = config('services.paypal.client_id');
        $clientSecret = config('services.paypal.client_secret');
        $mode = config('services.paypal.mode', 'sandbox');

        if (!$clientId || !$clientSecret || str_starts_with((string) $orderId, 'SANDBOX-')) {
            return null;
        }

        $auth = base64_encode($clientId . ':' . $clientSecret);

        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'Authorization' => 'Basic ' . $auth,
            'Content-Type' => 'application/json',
        ])->post('https://api-m.' . $mode . '.paypal.com/v2/checkout/orders/' . $orderId . '/capture', []);

        return $response->successful() ? $response->json() : null;
    }

    /**
     * Mark a checkout as paid after a successful payment (card or PayPal).
     */
    public function markPaid($id)
    {
        $checkout = checkout::find($id);

        if ($checkout) {
            $checkout->update([
                'payment_status' => checkout::STATUS_PAID,
                'status' => checkout::STATUS_PAID,
            ]);
        }

        return response()->json(['success' => true, 'checkout' => $checkout]);
    }

    /**
     * Show the order complete page.
     */
    public function success($id)
    {
        $checkout = checkout::with('orderItems')->find($id);

        if (!$checkout) {
            return redirect('/checkout');
        }

        $categories = product_category::All();

        return view('order-complete', compact('checkout', 'categories'));
    }

    // ------------------------------------------------------------------
    // Resource methods kept for the resource route shape.
    // ------------------------------------------------------------------
    public function create()
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
