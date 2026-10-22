<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    /**
     * Save a newsletter signup from the home page.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email:filter|max:120',
        ]);

        $subscriber = subscriber::updateOrCreate(
            ['email' => strtolower($validated['email'])],
            ['user_id' => $request->user()?->id]
        );

        $message = $subscriber->wasRecentlyCreated
            ? 'Thanks! ' . $validated['email'] . ' is on the list.'
            : 'You are already on the list — nothing to do.';

        return response()->json(['success' => true, 'message' => $message]);
    }
}
