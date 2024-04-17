<?php

namespace App\Http\Controllers;

use App\Models\cart_item;
use App\Models\product_category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class product_categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = product_category::latest()->paginate(100);
        $number = cart_item::All();
        $carts = cart_item::latest()->take(2)->get();


        return view( 'product_categories.index' , compact('categories' , 'carts' , 'number') )
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
        $name = $request->input('name');
        $description = $request->input('description');

        $category = new product_category();
        $category->name = $name;
        $category->description = $description;
        $category->save();

        return redirect()->back()->with('success' , 'categorie ajouter avec success!');
    }

    /**
     * Display the specified resource.
     */
    public function show(product_category $product_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product_category $product_category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product_category $product_category)
    {

        $name = $request->input('name');
        $description = $request->input('description');

        $product_category->name = $name;
        $product_category->description = $description;
        $product_category->save();

        return redirect()->back()->with('success' , 'categorie sauvegarder avec success!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product_category $product_category)
    {
        $product_category->delete();
        return redirect()->back()->with('success' , 'categorie supprimer avec success!');
        
    }
}
