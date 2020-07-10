<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

/**
 * Class AdminGuestMiddleware
 * @package App\Http\Middleware
 */
class EmployeeAuthMiddleware
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

        if (!Auth::guard('employees')->check()) {
            return Redirect::to("/");
        }

	    return $next($request);
    }

}
