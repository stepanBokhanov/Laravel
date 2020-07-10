<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

/**
 * Class AdminGuestMiddleware
 * @package App\Http\Middleware
 */
class LockMiddleware
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
        if(Session::get('lock')==1)
        {
            return Redirect::to("screenlock");
        }

        return $next($request);
    }

}
