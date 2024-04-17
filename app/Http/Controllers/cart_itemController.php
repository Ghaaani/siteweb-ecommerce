<?php

namespace App\Http\Controllers;

use App\Models\cart_item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class cart_itemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $number = cart_item::All();
        $carts = cart_item::latest()->take(2)->get();

        return view('cart', compact('carts', 'number'))->with(request()->input('page'));

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
    public function show(cart_item $cart_item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cart_item $cart_item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cart_item $cart_item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cart_item $cart_item)
    {
        //
    }
}
