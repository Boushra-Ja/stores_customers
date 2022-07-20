<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Customer;
use App\Models\DiscountCode;
use App\Models\DiscountCustomer;
use App\Http\Requests\StoreDiscountCustomerRequest;
use App\Http\Requests\UpdateDiscountCustomerRequest;
use App\Http\Resources\BoshraRe\DiscountResource;
use App\Models\SecondrayClassification;
use Illuminate\Support\Facades\DB;

class DiscountCustomerController extends BaseController
{
    public static function store(int $discount_codes_id, int $customers_id)
    {
//        $discount_codes = DiscountCode::find($discount_codes_id);
//        $customers = Customer::find($customers_id);

        //$response = $discount_codes->Customers()->attach($customers);

        $response = DiscountCustomer::Create([
            'customers_id' => $customers_id,
            'discount_codes_id' => $discount_codes_id,
        ]);

        return response()->json($response, 200);
    }


    //boshra
    public function myDiscount($customer_id)
    {
        $customer_discount = DB::table('discount_customers')->where('customers_id' , $customer_id)
        ->join('discount_codes', 'discount_codes.id', '=', 'discount_customers.discount_codes_id')
        ->join('discounts', 'discounts.id', '=', 'discount_codes.discounts_id')
        ->get() ;

        return $this->sendResponse(DiscountResource::collection($customer_discount) , 'success') ;
    }

}
