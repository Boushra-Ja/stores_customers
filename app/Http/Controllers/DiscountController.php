<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Discount;
use Illuminate\Http\Request;


class DiscountController extends BaseController
{

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'status' => 'nullable',
            'value' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'condition' => 'required',
            'condition_value' => 'required',
            'store_id' => 'required',
        ]);


        $input = $request->all();
        $discount = Discount::create($input);

        if ($discount) {

            if ($request->type == 1){
                DiscountProductController::store($request, $discount->id);}
            else
            {
                DiscountCodeController::store($request, $discount->id);
            }

            return $this->sendResponse($discount, 'Store Shop successfully');

        } else {
            return $this->sendErrors('failed in Store Shop', ['error' => 'not Store Shop']);

        }
    }
}
