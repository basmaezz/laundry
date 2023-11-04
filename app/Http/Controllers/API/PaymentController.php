<?php

namespace App\Http\Controllers\API;

use App;
use App\Http\Controllers\Controller;
use App\Models\AppUser;
use App\Models\BankAccount;
use App\Models\Banner;
use App\Models\Branche;
use App\Models\Cart;
use App\Models\CartExtra;
use App\Models\Category;
use App\Models\CategoryItem;
use App\Models\Coupon;
use App\Models\CouponShopCart;
use App\Models\MoneyAccount;
use App\Models\Notifications;
use App\Models\Order;
use App\Models\OrderAdditional;
use App\Models\OrderDetails;
use App\Models\OrderTable;
use App\Models\Package;
use App\Models\Product;
use App\Models\ProductService;
use App\Models\ProviderExtra;
use App\Models\Rate;
use App\Models\RequestDelivery;
use App\Models\SearchHistory;
use App\Models\Subcategory;
use App\Models\UserAddress;
use App\Models\UserDate;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Maize\Markable\Models\Favorite;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{

    public function request(Request $request){
        //entityType = ['MADA','VISA']
        //Amount = 11.00
        //auth
        $user = auth()->user();

        $entityId = $request->get("entityType") == "MADA"? config("payment.EntityID.MADA") : config("payment.EntityID.VISA");
        $client = new Client();

        $response = $client->post(config("payment.Url")."checkouts", [
            'headers' => [
                'Authorization' => 'Bearer '.config("payment.Authorization"),
                'Content-Type'  => 'application/x-www-form-urlencoded'
            ],
            'form_params' => [
                'entityId' => $entityId,
                'amount' => $request->get("amount"),
                'currency' => config("payment.Currency"),
                'paymentType' => config("payment.PaymentType"),

//                'testMode' => config("payment.testMode"),
//                'merchantTransactionId' => config("payment.PaymentType"),//todo
//                'customer.email' => $user->email,
//                'billing.street1' => $user->default_address->address,
//                'billing.city' => $user->default_address->city->name,
//                'billing.state' => $user->default_address->city->region_name,
//                'billing.country' => 'SA',
//                'billing.postcode' => '12345',
//                'customer.givenName' => $user->name,
//                'customer.surname' => $user->name,
            ]
        ]);
        //var_dump($response->getBody()->getContents());

        return response()->json(json_decode($response->getBody()->getContents(),true));
    }

    public function paymentStatus(Request $request){
        //entityType = ['MADA','VISA']
        //amount = 1
        //id = 8a82944a4cc25ebf014cc2c782423202
        //auth
        $client = new Client();

        $entityId = $request->get("entityType") == "MADA"? config("payment.EntityID.MADA") : config("payment.EntityID.VISA");

        $response = $client->get(config("payment.Url").'/'.$request->get("id").'/payment', [
            'query' => [
                'entityId'  => $entityId,
//                'amount'    => $request->get("amount"),
//                'currency'  => config("payment.Currency"),
//                'type'      => config("payment.PaymentType")
            ],
            'headers' => [
                'Authorization' => 'Bearer '.config("payment.Authorization")
            ]
        ]);
        return response()->json(json_decode($response->getBody()->getContents(),true));
    }
}
