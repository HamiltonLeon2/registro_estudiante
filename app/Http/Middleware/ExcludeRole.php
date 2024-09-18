<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ExcludeRole
{
    
    /**Handle an incoming request.*
     *   @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next*/
public function handle(Request $request, Closure $next): Response   
    { 
       
        $excludedRoles = ['personal de ingreso'];
        
        if (Auth()->user() && Auth()->user()->hasAnyRole($excludedRoles)) {
            // You can redirect or return an error response here
            return redirect()->route('datatable.show')->with('error', 'Access denied.');
        }

        return $next($request);
    }
}

