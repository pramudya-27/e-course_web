<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || !Auth::user()->is_admin) { // Jika user tidak login atau bukan admin
            return redirect('/')->with('error', 'You do not have admin access.');
        }
        return $next($request);
    }
}
    

