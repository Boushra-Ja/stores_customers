<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Discount;
use Illuminate\Http\Request;


class DiscountController extends BaseController
{

    public static function store(Request $request, $id)
    {
        $request->validate([
            'type' => 'required',
            'status' => 'nullable',
            'value' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $discount = Discount::create([
            'type' => $request->type,
            'status' => $request->status,
            'value' => $request->value,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'store_id' => $id,
        ]);

        if ($discount) {

            if ($request->type == 1) {
                DiscountProductController::store($request, $discount->id);
            } else {
                DiscountCodeController::store($request, $discount->id, $id);
            }
        }
    }
}
