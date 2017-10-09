<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class RedirectIfMarketplaceNotConnected
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
        if (!User::find(2)->stripe_id) {
            return redirect()->route('account.connect');
        }
        session(['stripe_seller_public_key' => User::find(2)->stripe_key]);
        return $next($request);
    }
}
