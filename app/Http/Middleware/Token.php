<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Token
{

    public function handle($request, Closure $next)
    {
        if ($request->header('token')) {

            $user_token  = $request->header('token');
            $_user       = User::where('api_token', $user_token)->first();
            $userConfirm = User::where(['api_token'=>$user_token , 'confirm' =>1])->first();

            if ($_user == null){
                return response()->json(['key' => '0', 'msg' => 'user not found']);
            }

            if ($_user->active == 0 ){
                return response()->json(['key' => '0', 'msg' => 'this user not active']);
            }

            if ($userConfirm) {

                return $next($request);
            }else {

                $data = ['token' => $user_token, 'msg' => 'this Account Not confirmed code'];
                return response()->json(['key' => '0', 'msg' => $data['msg']]);
            }


        } else {

            $data = ['msg' => 'Unauthorized User Token'];
            return response()->json(['key' => '0', 'msg' => $data['msg']]);
        }

    }
}
