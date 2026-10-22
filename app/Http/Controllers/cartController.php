<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\product_category;
use App\Models\cart_item;
use App\Models\cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class cartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = product_category::All();
        $cartItems = cart_item::all();
        $carts = cart_item::latest()->take(2)->get();
        $number = cart_item::all();

        if (request()->expectsJson()) {
            return response()->json(['products' => $cartItems]);
        }

        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += ($item->prix * $item->quantity);
        }

        return view('cart', compact('categories', 'carts', 'number', 'cartItems', 'totalPrice'))->with(request()->input('page'));
    }

    /**
     * Add a product to the cart (or increase its quantity if already there).
     */
    public function store(Request $request, $productId)
    {
        $product = product::find($productId);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }

        $item = cart_item::where('product_id', $product->id)->first();

        if ($item) {
            $item->quantity = (int) $item->quantity + 1;
            $item->prix = $product->price;
            $item->save();
        } else {
            cart_item::create([
                'product_id' => $product->id,
                'name' => $product->name,
                'prix' => $product->price,
                'quantity' => 1,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart',
            'cart' => cart_item::all(),
        ]);
    }

    /**
     * Increment a cart item quantity.
     */
    public function incQuantity(Request $request, $pId)
    {
        $item = cart_item::findOrFail($pId);
        $item->quantity = (int) $item->quantity + 1;
        $item->save();

        return response()->json([
            'success' => true,
            'message' => 'Product quantity updated successfully',
            'cart_item' => $item,
            'cart' => cart_item::all(),
        ]);
    }

    /**
     * Decrement a cart item quantity (delete it when it reaches zero).
     */
    public function decQuantity(Request $request, $pId)
    {
        $item = cart_item::find($pId);

        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Cart item not found'], 404);
        }

        $item->quantity = (int) $item->quantity - 1;

        if ((int) $item->quantity <= 0) {
            $item->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Product quantity updated successfully',
            'cart_item' => $item,
            'cart' => cart_item::all(),
        ]);
    }

    /**
     * Update cart item quantity to an explicit value.
     */
    public function updateQuantity(Request $request, $pId)
    {
        $item = cart_item::find($pId);

        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Cart item not found'], 404);
        }

        $quantity = (int) $request->input('quantity', $item->quantity);
        $quantity = max(1, $quantity);

        if ($quantity <= 0) {
            $item->delete();
        } else {
            $item->quantity = $quantity;
            $item->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Product quantity updated successfully',
            'cart_item' => $item,
            'cart' => cart_item::all(),
        ]);
    }

    /**
     * Remove a cart item.
     */
    public function destroy($id)
    {
        $item = cart_item::find($id);

        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Cart item not found'], 404);
        }

        $item->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product removed from cart',
            'cart' => cart_item::all(),
        ]);
    }

    // ------------------------------------------------------------------
    // Helper: totals for the whole cart
    // ------------------------------------------------------------------
    public static function cartTotal()
    {
        $items = cart_item::all();
        $subtotal = 0;
        foreach ($items as $item) {
            $subtotal += ((float) $item->prix) * ((int) $item->quantity);
        }
        $shipping = 0;
        $total = $subtotal + $shipping;

        return [
            'items' => $items,
            'subtotal' => round($subtotal, 2),
            'shipping' => $shipping,
            'total' => round($total, 2),
        ];
    }

    // ------------------------------------------------------------------
    // Show the form for creating a new resource.
    // ------------------------------------------------------------------
    public function create()
    {
        //
    }

    // ------------------------------------------------------------------
    // Store a newly created resource in storage.
    // ------------------------------------------------------------------
    public function storeForm(Request $request)
    {
        //
    }

    // ------------------------------------------------------------------
    // Display the specified resource.
    // ------------------------------------------------------------------
    public function show(cart $cart)
    {
        //
    }

    // ------------------------------------------------------------------
    // Show the form for editing the specified resource.
    // ------------------------------------------------------------------
    public function edit(cart $cart)
    {
        //
    }

    // ------------------------------------------------------------------
    // Update the specified resource in storage.
    // ------------------------------------------------------------------
    public function update(Request $request, cart $cart)
    {
        //
    }

    // ------------------------------------------------------------------
    // Remove the specified resource from storage.
    // ------------------------------------------------------------------
    public function destroyResource(cart $cart)
    {
        //
    }
}
