<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\cart_item;
use App\Models\product_category;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Show the customer dashboard: profile + order history.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $orders = $user->orders()->with('orderItems')->get();

        $categories = product_category::All();
        $carts = cart_item::latest()->take(2)->get();
        $number = cart_item::All();

        return view('account', compact('user', 'orders', 'categories', 'carts', 'number'));
    }
}
