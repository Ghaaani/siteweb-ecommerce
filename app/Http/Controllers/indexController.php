<?php

namespace App\Http\Controllers;

use App\Models\cart_item;
use App\Models\product_category;
use App\Models\product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function index()
    {
        $categories = product_category::take(3)->get();
        $products = product::take(4)->get();
        $number = cart_item::all();
        $carts = cart_item::latest()->take(2)->get();

        $productss = product::where('product_list', 'Popular Product')->get();

        if (request()->expectsJson()) {
            return response()->json(['products' => $productss]);
        }

        return view('index', compact('categories', 'products', 'carts', 'number', 'productss'))->with(request()->input('page'));
    }

    public function removeProduct($id)
    {
        $product = cart_item::find($id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Cart item not found'], 404);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product removed from cart',
            'cart' => cart_item::all(),
        ]);
    }
}
