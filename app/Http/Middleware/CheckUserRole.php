<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$guards)
{
    if (!auth()->check()) {
        return redirect('/login');
    }

    // Redirect accountants to journal entries
    if (auth()->user()->role === 'accountant') {
        return redirect('/journal');
    }

    return $next($request);
}

}
