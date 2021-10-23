<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Developer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::check()) {
            abort(404);
        }

        $emails = ['arafatkn@gmail.com'];

        if (! in_array(auth()->user()->email, $emails)) {
            abort(404);
        }

        return $next($request);
    }
}
