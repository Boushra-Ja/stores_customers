<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Discount;
use Illuminate\Http\Request;


class DiscountController extends BaseController
{

    public static function store( Request $request, $id,$h)
    {
//        $request->validate([
//            'type' => 'required',
//            'status' => 'nullable',
//            'value' => 'required',
//            'start_date' => 'required',
//            'end_date' => 'required',
//        ]);

        if($h==1){
            $discount = Discount::create([
                'type' => "1",
                'status' => "0",
                'value' => "0",
                'start_date' => "2022-06-13 09:38:43",
                'end_date' => "2022-06-13 09:38:43",
                'store_id' => $id,
            ]);

            if ($discount) {

                if ($discount->type == 1) {
                    DiscountProductController::store($request, $discount->id,$h);
                } else {
                    DiscountCodeController::store($request, $discount->id, $id);
                }
            }

        }else {

            $discount = Discount::create([
                'type' => $request["type"],
                'status' => $request["status"],
                'value' => $request["value"],
                'start_date' => $request["start_date"],
                'end_date' => $request["end_date"],
                'store_id' => $id,
            ]);

            if ($discount) {

                if ($request["type"] == 1) {
                    DiscountProductController::store($request, $discount->id,$h);
                } else {
                    DiscountCodeController::store($request, $discount->id, $id);
                }
            }
        }
    }
}
