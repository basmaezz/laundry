<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class MobileUserMiddleware
{
    public function handle($request, Closure $next)
    {

        if (isset($request->user_id ) || isset( $request->provider_id)) {

            $user_id     = $request->user_id ? $request->user_id : $request->provider_id;

            $_user       = User::where('id', $user_id)->first();

            $userConfirm = User::where(['id'=>$user_id , 'confirm' =>1])->first();

            if ($_user == null){
                return response()->json(['value' => '0', 'key' => 'fail', 'msg' => 'user not found']);
            }

            if ($_user->active == 0 ){
                return response()->json(['value' => '0', 'key' => 'fail', 'msg' => 'this user not active']);
            }

            if ($userConfirm) {
                return $next($request);
            }else {

                $data = ['user_id' => $user_id, 'msg' => 'this Account Not confirmed code'];
                return response()->json(['value' => '2', 'key' => 'fail', 'msg' => $data['msg']]);
            }

        } else {

            $data = ['msg' => 'Unauthorized User '];
            return response()->json(['value' => '0', 'key' => 'fail', 'msg' => $data['msg']]);
        }

    }

}
