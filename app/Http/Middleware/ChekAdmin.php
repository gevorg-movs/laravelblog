<?php

namespace App\Http\Middleware;

use Closure;

class ChekAdmin
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
         if (\Auth::user()->status != 'admin') {
              return redirect()->route('posts.index')->witherrors( 'Вы не администратор. Отказано в доступе');
         }

         return $next($request);
     }
}
