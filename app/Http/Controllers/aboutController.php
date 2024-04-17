<?php

namespace App\Http\Controllers;

use App\Models\cart_item;
use App\Models\about_us;
use App\Models\product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class aboutController extends Controller
{
    public function index()
    {

        $aboutt = about_us::first();
        $number = cart_item::All();
        $carts = cart_item::latest()->take(2)->get();


        return view('about', compact('aboutt', 'carts', 'number'))->with(request()->input('page'));

    }

}
