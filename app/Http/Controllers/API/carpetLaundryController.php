<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\carpetLaundry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class carpetLaundryController extends Controller
{
    public function index(){
        $result = carpetLaundry::get();
        $data = [];
        if (count($result)) {
            $user = auth('app_users_api')->user();
            foreach ($result as $carpetLaundry) {

                $distance = (!empty($user)) ? getDistanceFirst1($user, $carpetLaundry->lat, $carpetLaundry->lng) : 0;

                $range = $carpetLaundry->range;
                $data[] = [
                    'id' => $carpetLaundry->id,
                    'approximate_duration' => $carpetLaundry->approximate_duration,
                    'range' => $carpetLaundry->range,
                    'delivery_price' => $carpetLaundry->delivery_price,
                    'distance_class' =>  getDistanceClass($distance, $range),
                    'distance_class_id' =>  getDistanceClassId($distance, $range),
                ];
            }

            return apiResponse('api.in_area', $data);
        } else {
            return apiResponse('api.out_area', $data);
        }

    }
}
