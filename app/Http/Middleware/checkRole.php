<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Route;

use Auth;
use Closure;
use App\Models\Role;
use App\Models\Permission;
class checkRole
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
        $arr = [];
        $permission = Permission::where('role_id',Auth::user()->role)->select('permissions')->get();
        foreach($permission as $key=>$per)
        {
            $arr[$key] = $per->permissions;
        }

        if (in_array(Route::currentRouteName(), $arr) != false)
        {
            return $next($request);
        }else
        {
            abort('550');
        }


    }
}
