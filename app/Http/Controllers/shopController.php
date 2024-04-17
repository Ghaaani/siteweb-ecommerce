<?php

namespace App\Http\Controllers;


use App\Models\product_category;
use App\Models\product;
use App\Http\Controllers\Controller;
use App\Models\cart_item;
use Illuminate\Http\Request;

class shopController extends Controller
{
    public function index()
    {

        $categories = product_category::latest()->paginate(100);

        $productss = product::All();

        $carts = cart_item::latest()->take(2)->get();

        $number = cart_item::All();


        if (request()->expectsJson()) {
            return response()->json(['products' => $productss]);
        }
        else {
            return view('shop', compact('categories','carts', 'number'))->with(request()->input('page'));
        }

    }

    public function getProductsByCategory($category_id)
    {

        // Retrieve products based on the selected category
        $products = product::where('category_id', $category_id)->get();

        return response()->json(['products' => $products]);
    }

    public function inserProduct($product_id)
    {

        $product = Product::find($product_id);

        if ($product) {

            $existingCartItem = Cart_Item::where('product_id', $product->id)->first();

        if ($existingCartItem) {
            $existingCartItem->quantity++;
            $existingCartItem->save();
        } else {
            $cart_item = new Cart_Item();
            $cart_item->product_id = $product->id;
            $cart_item->name = $product->name;
            $cart_item->prix = $product->price;
            $cart_item->quantity = 1;
            $cart_item->save();
        }
        }   


        return response()->json(['products' => $product]);
    }

}


