<?php

namespace App\Http\Controllers;

use App\Models\cart_item;
use App\Models\product;
use App\Models\product_category;
use App\Models\checkout;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class checkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = product_category::All();
        $products = product::All();
        $number = cart_item::All();
        $carts = cart_item::latest()->take(2)->get();

        return view('checkout', compact('products','categories','carts','number'))
            ->with(request()->input('page'));
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
    public function show(checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(checkout $checkout)
    {
        //
    }
}
