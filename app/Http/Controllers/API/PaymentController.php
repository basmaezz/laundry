<?php

namespace App\Http\Controllers\API;

use App;
use App\Http\Controllers\Controller;
use App\Models\CheckoutRequest;
use App\Models\PaymentCard;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{

    public function request(Request $request){
        $user = auth('app_users_api')->user();
        switch ($request->get("entityType")){
            case "MADA":
                $entityId = config("payment.EntityID.MADA");
                break;
            case "VISA":
                $entityId = config("payment.EntityID.VISA");
                break;
            case "APPLE":
                $entityId = config("payment.EntityID.APPLE");
                break;
            default:
                return response()->json(['message'=>'entityType is wrong'],500);
        }
        $form_params = [
            'entityId' => $entityId,
            'amount' => floatval($request->get("amount")),
            'currency' => config("payment.Currency"),
            'paymentType' => config("payment.PaymentType"),
            'customer.email' => $user->email,
            'billing.street1' => $user->default_address->address??'Riyadh',
            'billing.city' => $user->default_address->city->name??'Riyadh',
            'billing.state' => $user->default_address->city->region_name??'Riyadh',
            'billing.country' => 'SA',
            'billing.postcode' => '17349',//TODO :: add lookup based onn region
            'customer.givenName' => $user->name,
            'customer.surname' => $user->name,
        ];
        if(config("payment.testMode") && $request->get("entityType") != "APPLE"){
            $form_params['testMode'] = 'EXTERNAL';
        }
        if(config("payment.CardStore")){
            $form_params['createRegistration'] = 'true';
            $form_params['customParameters[3DS2_enrolled]'] = 'true';
        }
        //list registrationId for old cards
        $payment_cards = PaymentCard::where(['user_id'=>$user->id])->get();
        foreach ($payment_cards as $i=>$payment_card){
            $form_params['registrations['.$i.'].id'] = $payment_card->registration_id;
        }


        $checkout_request = CheckoutRequest::create([
            'user_id' => $user->id,
            'status' => 'New',
            'payload' => json_encode($form_params),
        ]);
        $form_params['merchantTransactionId'] = str_pad($checkout_request->id, 6, '0', STR_PAD_LEFT);
        $client = new Client();

        $headers = [
            'Accept'        => 'application/json',
            'Authorization' => 'Bearer '.config("payment.Authorization"),
            'Content-Type'  => 'application/x-www-form-urlencoded'
        ];

        $options = [
            'form_params' => $form_params
        ];
        $request = new \GuzzleHttp\Psr7\Request('POST', config("payment.Url"), $headers);
        try {
            $response = $client->sendAsync($request, $options)->wait();
        } catch (\Exception $e) {
            echo \GuzzleHttp\Psr7\Message::toString($e->getRequest());
            echo \GuzzleHttp\Psr7\Message::toString($e->getResponse());
            dd($e->getMessage());
        }
        $response_body = json_decode($response->getBody(), true);
//        $response = $client->post(config("payment.Url"), [
//            'headers' => $headers,
//            'form_params' => $form_params
//        ]);
        //var_dump( (string) $response_body);
        //$response_content = (string) $response_body->getContents();

        $checkout_request->response = json_encode($response_body);
        $checkout_request->status = 'Sent';
        $checkout_request->save();

        //dd($response, $response_body);


        return response()->json($response_body);
    }

    public function paymentStatus(Request $request){
        $user = auth('app_users_api')->user();
        switch ($request->get("entityType")){
            case "MADA":
                $entityId = config("payment.EntityID.MADA");
                break;
            case "VISA":
                $entityId = config("payment.EntityID.VISA");
                break;
            case "APPLE":
                $entityId = config("payment.EntityID.APPLE");
                break;
            default:
                return response()->json(['message'=>'entityType is wrong'],500);
        }
        $client = new Client();

        $response = $client->get(config("payment.Url").'/'.$request->get("id").'/payment', [
            'query' => [
                'entityId'  => $entityId
            ],
            'headers' => [
                'Authorization' => 'Bearer '.config("payment.Authorization")
            ]
        ]);
        $_body = $response->getBody();
        $response_body = json_decode($_body, true);
        Log::info("Start Log response_body");
        Log::info($_body);
        Log::info("End Log response_body");
        if(!preg_match('/^(100\.[13]50)/', $response_body['result']['code'])){
            if(!empty($response_body['registrationId'])) {
                PaymentCard::updateOrCreate([
                    'user_id'           => $user->id,
                    'registration_id'   => $response_body['registrationId']
                ],[
                    'payment_brand'     => $response_body['paymentBrand']??'',
                    'last4digits'       => $response_body['card']["last4Digits"]??'',
                    'holder'            => $response_body['card']["holder"]??'',
                    'expiry_month'      => $response_body['card']["expiryMonth"]??'',
                    'expiry_year'       => $response_body['card']["expiryYear"]??''
                ]);
            }
        }
        return response()->json($response_body);
    }

    public function getStoreCards(){
        $user = auth('app_users_api')->user();
        $paymentCards = PaymentCard::where('user_id',$user->id)->get();
        return apiResponseOrders("api.my_cards",$paymentCards->count(), $paymentCards);
    }

    public function payByRegistration(Request $request){
        $validator = Validator::make($request->all(), [
            'amount'            => 'required',
            'entityType'        => 'required',
            'registrationId'    => 'required',
            'cvv'               => 'required',
        ]);
        if (!$validator->passes()) {
            return apiResponse(trans('api.error_validation'), $validator->errors()->toArray(), 500, 500);
        }
        $user = auth('app_users_api')->user();
        $url = str_replace('{RegistrationId}', $request->get('registrationId'), config("payment.payByRegistrationUrl"));

        switch ($request->get("entityType")){
            case "MADA":
                $entityId = config("payment.EntityID.MADA");
                break;
            case "VISA":
                $entityId = config("payment.EntityID.VISA");
                break;
            case "APPLE":
                $entityId = config("payment.EntityID.APPLE");
                break;
            default:
                return response()->json(['message'=>'entityType is wrong'],500);
        }
        $form_params = [
            'entityId'              => $entityId,
            'amount'                => floatval($request->get("amount")),
            'card.cvv'              => $request->get("cvv"),
            'currency'              => config("payment.Currency"),
            'paymentType'           => config("payment.PaymentType"),
            'customer.email'        => $user->email,
            'billing.street1'       => $user->default_address->address??'Riyadh',
            'billing.city'          => $user->default_address->city->name??'Riyadh',
            'billing.state'         => $user->default_address->city->region_name??'Riyadh',
            'billing.country'       => 'SA',
            'customParameters[3DS2_enrolled]' => 'true',
            'billing.postcode'      => '17349',//TODO :: add lookup based onn region
            'customer.givenName'    => $user->name,
            'customer.surname'      => $user->name,
            'customer.browser.acceptHeader'      => 'text/html',
            'customer.browser.screenColorDepth'  => '48',
            'customer.browser.javaEnabled'       => 'false',
            'customer.browser.language'          => 'en',
            'customer.browser.screenHeight'      => '1200',
            'customer.browser.screenWidth'       => '1600',
            'customer.browser.timezone'          => '60',
            'customer.browser.challengeWindow'   => '4',
            'customer.browser.userAgent'         => 'Mozilla/4.0 (MSIE 6.0; Windows NT 5.0)',
            'shopperResultUrl'                   => 'http://127.0.0.1:8000/paymentstatus/', 
        ];
        if(config("payment.testMode") && $request->get("entityType") != "APPLE"){
            $form_params['testMode'] = 'EXTERNAL';
        }
        $checkout_request = CheckoutRequest::create([
            'user_id' => $user->id,
            'status' => 'New',
            'payload' => json_encode($form_params),
        ]);
        $form_params['merchantTransactionId'] = str_pad($checkout_request->id, 6, '0', STR_PAD_LEFT);

        $client = new Client();

        $headers = [
            'Accept'        => 'application/json',
            'Authorization' => 'Bearer '.config("payment.Authorization"),
            'Content-Type'  => 'application/x-www-form-urlencoded'
        ];

        $options = [
            'form_params' => $form_params
        ];
        $request = new \GuzzleHttp\Psr7\Request('POST', $url, $headers);
        try {
            $response = $client->sendAsync($request, $options)->wait();
        } catch (\Exception $e) {
            echo \GuzzleHttp\Psr7\Message::toString($e->getRequest());
            echo \GuzzleHttp\Psr7\Message::toString($e->getResponse());
            dd($e->getMessage());
        }
        $response_body = json_decode($response->getBody(), true);

        $checkout_request->response = json_encode($response_body);
        $checkout_request->status = 'Sent';
        $checkout_request->save();

        return response()->json($response_body);
    }

    public function remove_registered_card($id){
        $user = auth('app_users_api')->user();
        $paymentCard = PaymentCard::where(['user_id'=>$user->id, 'registration_id'=>$id])->delete();
        return apiResponseOrders("api.card_removed",0, $paymentCard);
    }
}
