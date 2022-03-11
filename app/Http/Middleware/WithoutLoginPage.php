<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class WithoutLoginPage
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
        if (Auth::check())
        {
            if ($request->url() === url()->to('sign-up') || $request->url() === url()->to('login')
                || $request->url() === url()->to('forget-password') || $request->url() === url()->to('reset-password')
                || $request->url() === url()->to('thank-you') || $request->url() === url()->to('register-next-step') ) {
                return redirect()->action('WebFrontend\DashboardController@dashboardPageDisplay');
            }
        }
        return $next($request);
    }
}
