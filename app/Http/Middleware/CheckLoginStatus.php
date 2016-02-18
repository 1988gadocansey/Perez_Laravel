<?php

namespace App\Http\Middleware;

use Closure;

class CheckLoginStatus
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
        if(!$request->session()->has('current_user')){
            return redirect('login')->withErrors("<script>window.parent.location=".url('login')."</script>");
        }
        return $next($request);
    }
}
