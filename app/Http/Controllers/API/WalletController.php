<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\Address;
use App\Models\Payment;
use App\Models\Transaction;
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
        return apiResponse(trans('api.all'), getUserObject(auth('app_users_api')->user()), 200, 200);
    }

    /**
     * increase amount
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function increase(Request $request)
    {
        $app_user_id = auth('app_users_api')->user()->id;
        $validator = Validator::make($request->all(), [
            'amount'      => 'required|numeric|between:0,99999.99',
        ]);
        if (!$validator->passes()) {
            return apiResponse(trans('api.error_validation'), $validator->errors()->toArray(), 500, 500);
        }
        $user = auth('app_users_api')->user();
        $user->wallet += floatval($request->amount);//number_format($request->amount);
        $user->save();

        foreach ($request->get('payments') as $payment) {
            Payment::create([
                'user_id'           => $app_user_id,
                'transaction_id'    => $payment['id'] ?? null,
                'status'            => $payment['status'] ?? 'Unknown',
                'payload'           => $payment['payload'] ?? null
            ]);
        }
        Transaction::create([
            'app_user_id'   => auth('app_users_api')->user()->id,
            'type'          => 'wallet',
            'amount'        => floatval($request->amount),
            'current_amount' => floatval($user->wallet),
            'direction'     => 'in'
        ]);
        return apiResponse(trans('api.add_successfully'), $user, 200, 201);
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
            return apiResponse(trans('api.error_validation'), $validator->errors()->toArray(), 500, 500);
        }

        $user = auth('app_users_api')->user();
        $wallet = (int) (str_ireplace(',', '', $user->wallet));
        if ($wallet < $request->get("amount")) {
            return apiResponse(trans('api.wallet_amount_not_enough'), null, 500, 500);
        }

        $wallet -= floatval($request->get("amount"));
        $user->wallet=$wallet;
        $user->save();
        Transaction::create([
            'app_user_id'   => auth('app_users_api')->user()->id,
            'type'          => 'wallet',
            'amount'        => floatval($request->get("amount")),
            'current_amount' => floatval($user->wallet),
            'direction'     => 'out'
        ]);

        return apiResponse(trans('api.successfully_updated'), $user, 200, 201);
    }

    public function transactions()
    {
        $transactions = Transaction::where('app_user_id', auth('app_users_api')->user()->id)->latest()->get();
        return apiResponse(trans('api.all'), $transactions, 200, 200);
    }

    public function last_transaction()
    {
        $transaction = Transaction::where('app_user_id', auth('app_users_api')->user()->id)->latest()->first();
        return apiResponse(trans('api.all'), $transaction, 200, 200);
    }
}
