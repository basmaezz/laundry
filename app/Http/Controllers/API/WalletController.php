<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WalletController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return apiResponse(trans('api.all'), getUserObject(auth('app_users_api')->user()),200,200);
    }

    /**
     * increase amount
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function increase(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount'      => 'required|numeric|between:0,99999.99',
        ]);
        if (!$validator->passes()) {
            return apiResponse(trans('api.error_validation'), $validator->errors()->toArray(),500,500);
        }
        $user= auth('app_users_api')->user();
        $user->wallet += floatval($request->get("amount"));
        $user->save();
        return apiResponse(trans('api.add_successfully'), $user,200,201);
    }


    /**
     * decrease amount.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function decrease(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount'       => 'required|numeric|between:0,99999.99',
        ]);
        if (!$validator->passes()) {
            return apiResponse(trans('api.error_validation'), $validator->errors()->toArray(),500,500);
        }

        $user= auth('app_users_api')->user();

        if($user->wallet < $request->get("amount")){
            return apiResponse(trans('api.wallet_amount_not_enough'), null,500,500);
        }
        $user->wallet -= floatval($request->get("amount"));
        $user->save();

        return apiResponse(trans('api.successfully_updated'), $user,200,200);
    }

}
