<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Redirect;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) 
        {
            case 'admin' :
                if (Auth::guard($guard)->check()) {
                    return redirect('/admin/login');
                }
                break;
            case 'mahasiswa' :
                if (Auth::guard($guard)->check()) {
                    return redirect('/login');
                }
                break;
            case 'operator' :
                if (Auth::guard($guard)->check()) {
                    return redirect('/operator/login');
                }
                break;
            case 'wakildekan' :
                if (Auth::guard($guard)->check()) {
                    return redirect('/wakildekan/login');
                }
                break;
            case 'dosen' :
                if (Auth::guard($guard)->check()) {
                    return redirect('/dosen/login');
                }
                break;
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('home');
                }
                break;
        }
        return $next($request);
    }
}