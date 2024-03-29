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
        if (!empty($request->file("image"))) {
            $input['image'] = uploadFile($request->file("image"), 'users_image');
        }
        $item = Address::create($input);
        return apiResponse(trans('api.add_successfully'), $item, 200, 201);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */

    public function updateAddress(Request $request, $id)
    {
        $address=Address::find($id);
        if ($address->app_user_id != auth('app_users_api')->user()->id) {
            return apiResponse(trans('api.error_validation'), null, 500, 500);
        }
        Address::where('app_user_id', auth('app_users_api')->user()->id)
            ->update(['default' => 1]);

        return apiResponse(trans('api.successfully_updated'), $address, 200, 200);

    }
    public function update(Request $request, $id)
    {
        $address=Address::find($id);

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
        if (!empty($request->file("image"))) {
            $input['image'] = uploadFile($request->file("image"), 'users_image');
        }
        $address->update($input);
        return apiResponse(trans('api.successfully_updated'), $address, 200, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address=Address::withCount('ordersTable')->find($id);
        if($address->orders_table_count > 0){
            foreach ($address->ordersTable as $order){
                $order->update([
                    'address_id'=>Null
                ]);
            }
        }
        if($address->app_user_id != auth('app_users_api')->user()->id && $address->orders_table_count>0){
            return apiResponse(trans('api.error_validation'), null, 500, 500);
        }
        if ($address->default) {
            return apiResponse(trans('api.not_able_to_delete_default'), null, 500, 500);
        }
        $address->delete();
        return apiResponse(trans('api.deleted_successfully'), null, 200, 200);
    }
}
