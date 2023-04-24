<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MenuAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $menu = config('adminlte.menu');
        $user_role = auth()->user()->role;
        $filtered_menu = array_filter($menu, function ($item) use ($user_role){
            return !isset($item['role']) || $item['role'] == $user_role;
        });
        config(['adminlte.menu' => $filtered_menu]);
        return $next($request);
    }
}
