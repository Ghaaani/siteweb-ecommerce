<?php

namespace App\Http\Controllers;

use App\Models\cart_item;
use App\Models\contact;
use App\Models\contactMessage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class contactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contact = contact::all();
        $number = cart_item::All();
        $carts = cart_item::latest()->take(2)->get();

        return view('contact', compact('contact','carts','number'))
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
     * Store a message sent from the contact page form.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'con_name'    => 'required|string|max:120',
            'con_email'   => 'required|email:filter|max:150',
            'con_subject' => 'nullable|string|max:150',
            'con_phone'   => 'nullable|string|max:30',
            'con_message' => 'required|string|max:5000',
        ]);

        contactMessage::create([
            'name'    => $validated['con_name'],
            'email'   => $validated['con_email'],
            'phone'   => $validated['con_phone'] ?? null,
            'subject' => $validated['con_subject'] ?? null,
            'message' => $validated['con_message'],
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thanks, ' . $validated['con_name'] . '. Your message reached us — we usually reply within one business day.',
            ]);
        }

        return redirect()
            ->route('contact.index', ['#contact-form'])
            ->with('success', 'Thanks, ' . $validated['con_name'] . '. Your message reached us — we usually reply within one business day.');
    }

    /**
     * Display the specified resource.
     */
    public function show(contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(contact $contact)
    {
        //
    }
}
