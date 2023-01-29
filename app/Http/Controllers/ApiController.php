<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Config;
class ApiController extends Controller
{

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    public $user;
    public $request;

    /**
     * ApiController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {
            if (isset($request->user)) {
                $this->user = $request->user;
                unset($request->user);
            }
            return $next($request);
        });
        \Config::set('auth.providers.users.model', \App\Models\AppUser::class);
    }

}
