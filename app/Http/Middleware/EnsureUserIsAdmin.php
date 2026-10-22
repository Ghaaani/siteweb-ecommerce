<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Only administrators may reach the admin area.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || !$request->user()->isAdmin()) {
            return redirect('/login')->withErrors([
                'email' => 'This account does not have access to the admin area.',
            ]);
        }

        return $next($request);
    }
}
