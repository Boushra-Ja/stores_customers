<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Customer;
use App\Models\Discount;
use App\Models\DiscountCode;
use Illuminate\Http\Request;

class DiscountCodeController extends BaseController
{

    public static function store(Request $request ,$id ){
        $request->validate([
            'its_for'=> 'nullable',
            'discount_code'=> 'required',
        ]);

        $discount = DiscountCode::create([
           // 'usage_times'=> $request->usage_times,
            'its_for'=> $request->its_for,
            'discount_code'=> $request->discount_code,
            'discounts_id'=> $id
        ]);

        if($request->its_for == 1){
            $customers = Customer::all();
            foreach ($customers as $c){
                DiscountCustomerController::store($discount->id,$c->id,$request->usage_times);
            }
        }
        else{
            foreach ($request->customer as $c){
                DiscountCustomerController::store($discount->id,$c,$request->usage_times);
            }
        }


    }


}
