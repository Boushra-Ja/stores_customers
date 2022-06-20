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
    public static function store(int $discount_codes_id, int $customers_id)
    {
        $discount_codes = DiscountCode::find($discount_codes_id);
        $customers = Customer::find($customers_id);

        $response = $discount_codes->Customers()->attach($customers);

        return response()->json($response, 200);
    }

}
