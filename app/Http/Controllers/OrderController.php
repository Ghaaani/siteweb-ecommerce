<?php

namespace App\Http\Controllers;

use App\Models\cart_item;
use App\Models\checkout;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * List every order placed in the shop.
     */
    public function index()
    {
        $orders = checkout::with('orderItems')->latest()->paginate(20);

        $number = cart_item::All();
        $carts = cart_item::latest()->take(2)->get();

        return view('orders.index', compact('orders', 'number', 'carts'));
    }

    /**
     * Show a single order with its items.
     */
    public function show($id)
    {
        $order = checkout::with('orderItems')->findOrFail($id);

        $number = cart_item::All();
        $carts = cart_item::latest()->take(2)->get();

        return view('orders.show', compact('order', 'number', 'carts'));
    }

    /**
     * Update the fulfilment status of an order.
     */
    public function update(Request $request, $id)
    {
        $order = checkout::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,paid,shipped,completed,cancelled',
        ]);

        $order->update([
            'status' => $validated['status'],
            'payment_status' => $validated['status'] === 'cancelled'
                ? checkout::STATUS_FAILED
                : $order->payment_status,
        ]);

        return redirect()->route('orders.index')->with('success', 'Order #' . $order->id . ' updated.');
    }
}
