<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $level = 4;
        if (
            Auth::user()
                ->roles->pluck("name")
                ->count() == 0
        ) {
            session(["level" => $level]);
            return $next($request);
        }
        switch (Auth::user()->roles->pluck("name")[0]) {
            case "مدیر اصلی":
                $level = 1;
                break;
            case "ناظر":
                $level = 2;
                break;
            case "مدیر طبقه":
                $level = 3;
                break;
            case "کارشناس":
                $level = 4;
                break;
        }
        session(["level" => $level]);
        return $next($request);
    }
}
