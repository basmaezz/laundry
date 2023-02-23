<?php

namespace App\Http\Controllers\API;

use App;
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
        $items = Address::where("app_user_id", $user_id)->get();
        dd($items);
        return apiResponse(trans('api.all'), $items, 200, 200);
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
            'description'   => 'nullable',
            'image'         => 'nullable|image',
            'address'       => 'required',
            'region_name'   => 'required',
            'city_id'       => 'required',
            'building'      => 'required',
        ]);
        if (!$validator->passes()) {
            return apiResponse(trans('api.error_validation'), $validator->errors()->toArray(), 500, 500);
        }
        $input = $request->except('image');
        $input['app_user_id'] = auth('app_users_api')->user()->id;
        $input['description'] = $request->get("description", "other");

        if ($input['default']) {
            Address::where('app_user_id', auth('app_users_api')->user()->id)
                ->update(['default' => false]);
        }
        $count = Address::where([
            'app_user_id' => auth('app_users_api')->user()->id,
            'default' => true
        ])->count();
        if ($count == 0) {
            $input['default'] = true;
        }
        $item = Address::create($input);
        if (!empty($request->file("image"))) {
            $item->image = uploadFile($request->file("image"), 'users_image');
        }
        return apiResponse(trans('api.add_successfully'), $item, 200, 201);
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
            'description'   => 'nullable',
            'image'         => 'nullable|image',
            'address'       => 'required',
            'region_name'   => 'required',
            'city_id'       => 'required',
            'building'      => 'required',
        ]);
        if (!$validator->passes()) {
            return apiResponse(trans('api.error_validation'), $validator->errors()->toArray(), 500, 500);
        }
        if ($address->app_user_id != auth('app_users_api')->user()->id) {
            return apiResponse(trans('api.error_validation'), null, 500, 500);
        }
        $input = $request->except('image');
        $input['app_user_id'] = auth('app_users_api')->user()->id;

        if ($input['default'] && !$address->default) {
            Address::where('app_user_id', auth('app_users_api')->user()->id)
                ->update(['default' => 0]);
        }
        $count = Address::where([
            'app_user_id' => auth('app_users_api')->user()->id,
            'default' => 1
        ])->count();
        if ($count == 0) {
            $input['default'] = 1;
        }
        $address->update($input);
        if (!empty($request->file("image"))) {
            $address->image = uploadFile($request->file("image"), 'users_image');
        }
        return apiResponse(trans('api.successfully_updated'), $address, 200, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        $item = Address::where("app_user_id", auth('app_users_api')->user()->id)->first();
        if ($item->app_user_id != auth('app_users_api')->user()->id) {
            return apiResponse(trans('api.error_validation'), null, 500, 500);
        }
        if ($address->default) {
            return apiResponse(trans('api.not_able_to_delete_default'), null, 500, 500);
        }
        $item->delete();
        return apiResponse(trans('api.deleted_successfully'), null, 200, 200);
    }
}
