<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{

    public function handle(Request $request, Closure $next)
    {

        // dd(Auth::user()->id);
        if(!empty(Auth::user())){


            if(url()->current() == route('auth#loginPage') || url()->current() == route('auth#registerPage')){
                return redirect()->route('category#list');
            }

        }

        return $next($request);

    }
}
