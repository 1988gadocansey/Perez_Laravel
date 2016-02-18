<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Session\Store;

    class SessionTimeout {
    protected $session;
    protected $timeout=864000;

    public function __construct(Store $session){
        $this->session=$session;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$this->session->has('lastActivityTime'))
            $this->session->put('lastActivityTime',time());
        elseif(time() - $this->session->get('lastActivityTime') > $this->timeout){
            $this->session->forget('lastActivityTime');
//            Auth::logout();
            \App\Http\Controllers\AuthController::dologout($request);

             $cookie=  \Cookie::forget('ropay_s');
        return redirect("/")->withErrors(array("<script>parent.location=".url('login')."</script>",'You had no activity in '.$this->timeout/60 .' minutes ago.'))->withCookie($cookie);
        }
        $this->session->put('lastActivityTime',time());
        return $next($request);
    }

}
