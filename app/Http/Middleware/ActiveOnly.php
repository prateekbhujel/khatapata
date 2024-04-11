<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ActiveOnly
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the 'cms' guard is in use and if a user is authenticated
        $cmsUser = $request->user('cms');
        if ($cmsUser && $cmsUser->status === 'Inactive') {
            // Redirect to admin inactive page if the 'cms' user is inactive
            return to_route('admin.errors.inactive');
        }
        
        // Check if the default guard user is authenticated
        $user = $request->user();
        if ($user && $user->status === 'Inactive') {
            // Redirect to user inactive page if the default guard user is inactive
            return to_route('user.errors.inactive');
        }
        
        // Continue to the next middleware or request handler
        return $next($request);
    }
}
