<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Http\ResourcesBayan\customerResource;
use App\Http\ResourcesBayan\discountCodeResource;
use App\Models\DiscountCode;
use App\Models\Order;
use Illuminate\Http\Request;

class DiscountCodeController extends BaseController
{

    public static function store(Request $request, $id, $stor_id, $h)
    {

        if ($h == 1) {

            $discount = DiscountCode::create([
                'discount_code' => ".",
                'discounts_id' => $id,
                'condition' => ".",
                'condition_value' => 0,
            ]);

        } else {
            $request->validate([
                'discount_code' => 'required',
                'condition' => 'required',
                'condition_value' => 'required',
            ]);

            //product  1
            //price    2
////تعديلللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللللل
            $discount = DiscountCode::create([
                'discount_code' => $request->discount_code,
                'discounts_id' => $id,
//            'condition' => $request->condition,
//            'condition_value' => $request->condition_value,
            ]);
//        if($request->its_for == 1){
//            $customers = Customer::all();
//            foreach ($customers as $c){
//                DiscountCustomerController::store($discount->id,$c->id,$request->usage_times);
//            }
//        }
//        else{
//            foreach ($request->customer as $c){
//                DiscountCustomerController::store($discount->id,$c,$request->usage_times);
//            }
//        }


            $order = Order::where('store_id', '=', $stor_id)->get();

            $d = $order->groupBy('customer_id');


            if ($request->condition == 2) {

                $customer = customerResource::collection($d);

                $customers = $customer->where($customer->total, '>=', $request->condition_value);
                foreach ($customers as $c) {
                    DiscountCustomerController::store($discount->id, $c->id, $request->usage_times);
                }
            } else {

                $customer = discountCodeResource::collection($d);
                $customers = $customer->where($customer->count, '>=', $request->condition_value);

                foreach ($customers as $c) {
                    DiscountCustomerController::store($discount->id, $c->id, $request->usage_times);
                }
            }

        }

    }


}
