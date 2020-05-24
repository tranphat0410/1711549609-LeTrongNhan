<?php

namespace App\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Closure;

class CheckAdmin
{
    protected $auth;
    public function __construct(Guard $auth)
    {
       $this->auth = $auth;
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
        if(!$this->auth->check()){
            return redirect()->guest('/dang-nhap');
        }
        $user =$this->auth->user();
        if(!$user->is_admin){
            return redirect()->guest('/');
        }
        return $next($request);
    }
}

