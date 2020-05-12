<?php

namespace App\Http\Middleware;

use Closure,Session;

class PenerimaSuratKPP
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
                return $next($request);
            // if (session('level')!='penerima_surat_kpp') {
            //     return redirect(session('level'));
            // }else{
            // }
        }
    }
}
