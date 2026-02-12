<?php

namespace YourVendor\ContactForm\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminRole
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user || $user->role !== 'admin') {
            // Redirect HTML requests, JSON for API requests
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Forbidden. Admin access required.',
                ], 403);
            }

            return redirect()
                ->route('contact-form.admin.login')
                ->with('error', 'You do not have admin access.');
        }

        return $next($request);
    }
}
