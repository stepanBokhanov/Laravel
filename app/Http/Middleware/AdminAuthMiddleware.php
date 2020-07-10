<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

/**
 * Class AdminGuestMiddleware
 * @package App\Http\Middleware
 */
class AdminAuthMiddleware
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
        if (!Auth::guard('admin')->check()){
            return Redirect::route("admin.getlogin");
        }

	       return $next($request);
    }

}
