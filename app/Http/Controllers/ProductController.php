<?php

namespace App\Http\Controllers;

use App\Models\cart_item;
use App\Models\product;
use App\Models\product_category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

    

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = product::latest()->paginate(100);
        $categories = product_category::latest()->paginate(100);
        $number = cart_item::All();
        $carts = cart_item::latest()->take(2)->get();


        return view( 'products.index' , compact('products' , 'categories','number', 'carts') )
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
        $image = $request->file('image')->store('public/images/product/');
        $name = $request->input('name');
        $description = $request->input('description');
        $price = $request->input('price');
        $SKU = $request->input('SKU');
        $category = $request->input('category');
    
        $bestseller = $request->has('BestSeller');
        $popularproduct = $request->has('PopularProduct');
    
        $product_list = null;
    
        if ($bestseller) {
            $product_list = 'Best Seller';
        } elseif ($popularproduct) {
            $product_list = 'Popular Product';
        }
    
        $product = new Product();
        $product->image = basename($image);
        $product->name = $name;
        $product->description = $description;
        $product->price = $price;
        $product->SKU = $SKU;
        $product->category_id = $category;
        $product->product_list = $product_list;
        $product->save();

            return redirect()->back()->with('success' , 'product ajouter avec success!');



    }
    
    

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {

        if ($request->hasFile('image')){
            $image = $request->file('image')->store('public/images/product/');
            $product->image = basename($image);
        }

        $name = $request->input('name');
        $description = $request->input('description');
        $price = $request->input('price');
        $SKU = $request->input('SKU');
        $category = $request->input('category');

        $product->name = $name;
        $product->description = $description;
        $product->price = $price;
        $product->SKU = $SKU;
        $product->category_id= $category;
        $product->save();

        return redirect()->back()->with('success' , 'product modifer avec success!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        $product->delete();
        return redirect()->back()->with('success' , 'product supprimer avec success!');
    }
}
