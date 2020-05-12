<?php

namespace App\Http\Middleware;

use Closure;

class SuperadminMiddleware
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
        if (session('id_user')==null) {
            return redirect('');
        }else{
            if (session('level')!='superadmin') {
                return redirect(session('level'));
            }
            return $next($request);
        }
    }
}
