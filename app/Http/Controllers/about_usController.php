<?php

namespace App\Http\Controllers;

use App\Models\cart_item;
use App\Models\about_us;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class about_usController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = about_us::first();
        $number = cart_item::All();
        $carts = cart_item::latest()->take(2)->get();


        return view('about_uses.index', compact('about', 'carts', 'number'))->with(request()->input('page'));


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
 
        $titre = $request->input('titre');
        $sous_titre = $request->input('sous_titre');
        $description = $request->input('description');
        $image = $request->file('image')->store('public/images/about/');


        $about_us = new about_us();
        $about_us->titre = $titre;
        $about_us->sous_titre = $sous_titre;
        $about_us->description = $description;
        $about_us->image = basename($image);
        $about_us->save();

            return redirect()->back()->with('success' , 'les informations ajouter avec success!');
    }

    /**
     * Display the specified resource.
     */
    public function show(about_us $about_us)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(about_us $about_us)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $about_us)
    {

        if ($request->hasFile('image')) {
            // Get the uploaded file
            $image = $request->file('image');
            
            // Generate a unique filename for the image
            $imageName = time().'.'.$image->getClientOriginalExtension();
            
            // Move the uploaded file to the desired directory
            $image->move(public_path('public/images/about/'), $imageName);
            
            // Update the database field for the image path
            about_us::where('id', $about_us)->update([
                'image' => 'public/images/about/'.$imageName,
                // Add other fields as needed
            ]);
        }
    
        about_us::where('id', $about_us)->update([
            
            "titre" => $request->input("titre"),
            "sous_titre" => $request->input("sous_titre"),
            "description" => $request->input("description")
            ]);
    

        // if ($request->hasFile('image')){
        //     $image = $request->file('image')->store('public/images/about/');
        //     $about_us->image = basename($image);
        // }

        // $titre = $request->input('titre');
        // $sous_titre = $request->input('sous_titre');
        // $description = $request->input('description');


        // $about_us->titre = $titre;
        // $about_us->sous_titre = $sous_titre;
        // $about_us->description = $description;
        // $about_us->save();

        return redirect()->back()->with('success' , 'les informations sauvegarder avec success!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(about_us $about_us)
    {
        $about_us->delete();
        return redirect()->back()->with('success' , 'les informations supprimer avec success!');
    }
}
