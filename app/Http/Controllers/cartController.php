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
        $cartItem = cart_item::All();
        $number = cart_item::All();
        $carts = cart_item::latest()->take(2)->get();


        if (request()->expectsJson()) {
            return response()->json(['products' => $cartItem]);
        }
        else {
            return view('cart', compact('categories','carts','number'))
            ->with(request()->input('page'));
        }

    }

    public function incQuantity(Request $request, $pId)
    {
        // Retrieve the product by ID
        $product = cart_item::findOrFail($pId);

        // Update the quantity of the product
        $product->quantity = $product->quantity + 1;
        $product->save();

        // You can return a response if needed
        return response()->json(['success' => true, 'message' => 'Product quantity updated successfully']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cart $cart)
    {
        //
    }
}
