<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Year;
use Illuminate\Http\Request;

class YearController extends ApiController
{
    public function index()
    {
        $years=Year::all();
        $data =[];
        foreach ($years as $year){
            $data[]=[
                'id'=>$year->id,
                'yearManufacture'=>$year->name
            ];
        }
        return apiResponse("api.success", $data);
    }
}
