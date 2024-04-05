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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user('cms')->status == 'Inactive'){
            
            return to_route('admin.errors.inactive');
        }

            if($request->user('auth')->status == 'Inactive'){

                return to_route('admin.errors.inactive');
            }
        return $next($request);
    }
}
