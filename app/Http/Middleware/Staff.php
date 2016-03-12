<?php

namespace App\Http\Middleware;

use Closure;

class Staff
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $userPermissionId = Auth::guard($guard)->user()->permission->slug;
        if($userPermissionId != 'staff'){
            return redirect('/')
                    ->withMessage('You don\'t have permission to access this section. Please ask the administrator for permission.');
        }
        return $next($request);
    }
}
