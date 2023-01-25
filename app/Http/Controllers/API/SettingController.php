<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\RegistrationCompany;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Carbon\CarbonPeriod;
use App\Models\Contact;
use App\Models\Social;
use App\Models\Page;
use App\Models\City;
use App\Models\Region;
use Carbon\Carbon;
use Validator;
use Auth;
use File;
use App;

class SettingController extends Controller
{
    /**  public function terms  . */
    public function terms()
    {
        $content = Page::where('name','terms')->select('content_'. App::getLocale() . ' as content')->first();

        return responseJsonData($content->content);
    }

    /**  public function about  . */
    public function about()
    {
        $content = Page::where('name','about')->select('content_'. App::getLocale() . ' as content')->first();

        return responseJsonData($content->content);
    }

    /**  public function cities  . */
    public function cities()
    {
        try {
            $cities = City::select('id','name_'. App::getLocale() . ' as name')->get();
            $data=[];
            $name='name_'.app()->getLocale();
            foreach ($cities as $k=>$row){
                $data[$k]=$row;
                $regions = [];
                foreach (Region::where('city_id',$row->id)->get() as $item){
                    $regions[]=[
                        'id'=>$item->id,
                        'name'=>$item->$name,
                    ];
                }

                $data[$k]['regions']=$regions;

            }
            return apiResponse("api.success",$data);

        }catch (\PDOException $ex) {
            return apiResponse("api.expected_error",[],500,500);
        }
    }

    public function regions($id)
    {
        try {
            $cities = Region::select('id','name_'. App::getLocale() . ' as name')->where('city_id',$id)->get();
            return apiResponse("api.success",$cities);
        }catch (\PDOException $ex) {
            return apiResponse("api.expected_error",[],500,500);
        }
    }

    /**  public function contact Us . */
    public function contact_us()
    {

        $data ['email']     = setting()->email;
        $data ['phone']     = setting()->site_phone;
        $data ['whatsapp']  = setting()->whatsapp;

        $socials = Social::select('id','name','link')->latest()->get();

        return response()->json(["value"=>"1","key"=>"success","data"=>$data,'socials'=>$socials]);

    }

    /** public function register delegate .** */
    public function register_delegate()
    {
        return responseJsonData( (int) setting()->register_delegate);
    }

    /**  public function complaints . ** */
    public function complaints(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required',
            'phone'       => 'required',
            'subject'     => 'required',
            'message'     => 'required',
        ]);

        if ($validator->passes()) {

            Contact::create($request->all());

            return responseJsonData(trans('api.send_contact'));
        }
        return response()->json($validator->errors());
    }

    /**  public function follow us  . */
    public function follow_us()
    {
        $socials = Social::select('id','name','link')->where('name','<>','whatsapp')->latest()->get();

        return responseJsonData($socials);
    }

    /**  public function contact_whatsapp  . */
    public function contact_whatsapp()
    {
        $setting = SiteSetting::first();
        $data['whatsapp'] = $setting->whatsapp;

        return responseJsonData($setting->whatsapp);
    }

    /**  public function registration to store . */
    public function registration()
    {
        $setting = SiteSetting::first();
        $data['phone']    = $setting->phone;
        $data['whatsapp'] = $setting->whatsapp;

        return responseJsonData($data);
    }

    /**  public function calendar.*/
    public function calendar()
    {
        $period = CarbonPeriod::create(Carbon::now(), Carbon::now()->endOfYear());

        foreach($period as $date)
        {
            $dates [] = [
                'month'  => trans('months.'.$date->format('F')),
                'number' => $date->format('d'),
                'day'    => trans('days.'.$date->format('l')),
                'date'   => $date->format('Y-m-d'),
            ];
        }

        return responseJsonData($dates);
    }
}

