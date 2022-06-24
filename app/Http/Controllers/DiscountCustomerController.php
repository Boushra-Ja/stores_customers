<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DiscountCode;
use App\Models\DiscountCustomer;
use App\Http\Requests\StoreDiscountCustomerRequest;
use App\Http\Requests\UpdateDiscountCustomerRequest;
use App\Models\SecondrayClassification;

class DiscountCustomerController extends Controller
{
    public static function store(int $discount_codes_id, int $customers_id,$usage_times)
    {
//        $discount_codes = DiscountCode::find($discount_codes_id);
//        $customers = Customer::find($customers_id);

        //$response = $discount_codes->Customers()->attach($customers);

        $response = DiscountCustomer::Create([
            'customers_id' => $customers_id,
            'usage_times' =>$usage_times,
            //'status_id' => OrderStatus::where('status', 'في السلة')->value('id'),
            'discount_codes_id' => $discount_codes_id,
        ]);

        return response()->json($response, 200);
    }

}
