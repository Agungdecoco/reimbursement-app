<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next, ...$roles): Response
    // {
    //     if(Auth::user()->jabatan, $roles){
    //         return $next($request);
    //     }
          
    //     return response()->json(['You do not have permission to access for this page.']);
    // }

    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $user = auth()->user();

        if (in_array($user->jabatan, $roles)) {
            return $next($request);
        }

        abort(403, 'Akses ditolak.');
    }

}
