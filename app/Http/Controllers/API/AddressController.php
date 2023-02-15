<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth('app_users_api')->user()->id;
        $items = Address::where("app_user_id",$user_id)->get();
        return apiResponse(trans('api.all'), $items,200,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type'          => 'nullable|in:home,work,other',
            'address'       => 'required',
            'region_name'   => 'required',
            'city_id'       => 'required',
            'building'      => 'required',
        ], [
            'type.in'       => 'Type Must Be [ home - work - other ]',
        ]);
        if ($validator->passes()) {
            return apiResponse(trans('api.error_validation'), null,500,500);
        }
        $input = $request->all();
        $input['app_user_id'] = auth('app_users_api')->user()->id;
        $input['type'] = $request->get("type","other");
        if($input['default']) {
            Address::where('app_user_id', auth('app_users_api')->user()->id)
                ->update(['default' => false]);
        }
        $count = Address::where([
            'app_user_id' => auth('app_users_api')->user()->id,
            'default' => true
        ])->count();
        if($count == 0){
            $input['default'] = true;
        }
        $item = Address::create($input);
        return apiResponse(trans('api.add_successfully'), $item,200,201);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        $validator = Validator::make($request->all(), [
            'type'          => 'nullable|in:home,work,other',
            'address'       => 'required',
            'region_name'   => 'required',
            'city_id'       => 'required',
            'building'      => 'required',
        ], [
            'type.in'       => 'Type Must Be [ home - work - other ]',
        ]);
        if ($validator->passes()) {
            return apiResponse(trans('api.error_validation'), null,500,500);
        }
        if($address->app_user_id != auth('app_users_api')->user()->id){
            return apiResponse(trans('api.error_validation'), null,500,500);
        }
        $input = $request->all();
        $input['app_user_id'] = auth('app_users_api')->user()->id;

        if($input['default'] && !$address->default) {
            Address::where('app_user_id', auth('app_users_api')->user()->id)
                ->update(['default' => false]);
        }
        $count = Address::where([
            'app_user_id' => auth('app_users_api')->user()->id,
            'default' => true
        ])->count();
        if($count == 0){
            $input['default'] = true;
        }
        $item = $address->update($input);
        return apiResponse(trans('api.successfully_updated'), $item,200,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        if($address->app_user_id != auth('app_users_api')->user()->id){
            return apiResponse(trans('api.error_validation'), null,500,500);
        }
        $address->delete();
        return apiResponse(trans('api.deleted_successfully'), null,200,200);
    }
}
