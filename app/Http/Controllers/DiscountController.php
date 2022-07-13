<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Discount;
use App\Models\DiscountProduct;
use Illuminate\Http\Request;


class DiscountController extends BaseController
{

    public static function store(Request $request, $id, $h)
    {

        if ($h == 1) {
            $discount = Discount::create([
                'type' => "1",
                'status' => "0",
                'value' => "0",
                'start_date' => "2022-06-13 09:38:43",
                'end_date' => "2022-06-13 09:38:43",
                'store_id' => $id,
            ]);


            DiscountProductController::store($request, $discount->id, $h);

            $discount2 = Discount::create([
                'type' => "2",
                'status' => "0",
                'value' => "0",
                'start_date' => "2022-06-13 09:38:43",
                'end_date' => "2022-06-13 09:38:43",
                'store_id' => $id,
            ]);
            DiscountCodeController::store($request, $discount2->id, $id);


        } else {

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
                    DiscountProductController::store($request, $discount->id, $h);
                } else {
                    DiscountCodeController::store($request, $discount->id, $id);
                }
            }
        }
    }

    public function update(Request $request)
    {
        $descount = Discount::where('id', '=', $request->discounts_id)->first();
        if ($descount)
            $descount->update($request);
        if ($request->type == 1) {
            $descount_p = DiscountProductController::where('id', '=', $request->id)->first();
            $descount_p->update($request);
        } else {
            $descount_p = DiscountCodeController::where('id', '=', $request->id)->first();
            $descount_p->update($request);
        }

        return $this->sendResponse($descount, 'تم تعديل ملف الخصم بنجاح');


    }

    public function show($id, $type)
    {
        if ($type == 1) {
            $descount_p = DiscountProductController::where('id', '=', $id)->first();
            $descount=Discount::where('id','=',$descount_p->discounts_id)->first();
            response()->json([$descount_p,$descount], 200);
        } else {
            $descount_p = DiscountCodeController::where('id', '=', $id)->first();
            $descount=Discount::where('id','=',$descount_p->discounts_id)->first();
            response()->json([$descount_p,$descount], 200);
        }


    }
}
