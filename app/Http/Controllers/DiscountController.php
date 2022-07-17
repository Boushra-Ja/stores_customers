<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Http\ResourcesBayan\discount_coud;
use App\Http\ResourcesBayan\discount_resource;
use App\Models\Collection;
use App\Models\Discount;
use App\Models\DiscountCode;
use App\Models\DiscountProduct;
use App\Models\Product;
use Illuminate\Http\Request;


class DiscountController extends BaseController
{


    //apply_to
    //p  product
    //c collection
    //all all
    //bayan
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
            DiscountCodeController::store($request, $discount2->id, $id, $h);


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

                    DiscountCodeController::store($request, $discount->id, $id, $h);
                }
            }
        }
    }


    //bayan
    public function update(Request $request)
    {
        $descount = Discount::where('id', '=', $request->discounts_id)->first();
        if ($descount)
            $descount->update($request->all());


        if ($request->type == 1) {
            $descount_p = DiscountProduct::where('id', '=', $request->id)->first();
            $descount_p->update($request->all());

            if ($request["product"] != null) {
                $descount_0 = Discount::where('store_id', '=', $request->store_id)->where('value', '=', '0')->where('type','=',1)->value('id');
                $descount_product_0 = DiscountProduct::where('discounts_id', '=', $descount_0)->value('id');
                $poduct_descount = Product::where('discount_products_id', '=', $descount_p->id)->get();

                foreach ($poduct_descount as $p_value) {

                    $p_value->update(['discount_products_id' => $descount_product_0,]);

                }
                foreach ($request["product"] as $value) {
                    $product = Product::where('id', '=', $value)->first();
                    if ($product)
                        $product->update(['discount_products_id' => $request->id,]);

                }
            } else if ($request["groups"] != null) {
                foreach ($request["groups"] as $group) {
                    $g = Collection::where('id', '=', $group)->first();
                    $pro = Product::where('collection_id', '=', $g->id)->update(['discount_products_id' => $request->id,]);

                }
            }

        } else {
            $descount_p = DiscountCode::where('id', '=', $request->id)->first();
            $descount_p->update($request->all());
        }

        return $this->sendResponse($descount, 'تم تعديل ملف الخصم بنجاح');


    }

    //bayan
    public function show($id, $type)
    {
        $descount = Discount::where('id', '=', $id)->first();
        if ($type == 1) {
            $r = discount_resource::make($descount);
        } else {
            $r = discount_coud::make($descount);

        }
        return response()->json($r, 200);


    }

    //bayan
    public function index($id)
    {

        $a = array();
        $i = 0;
        $descount = Discount::where('store_id', '=', $id)->get();

        foreach ($descount as $value) {
            if ($value->type == 1) {

                $a[$i] = discount_resource::make($value);

            } else
                $a[$i] = discount_coud::make($value);
            $i += 1;

        }
        return response()->json($a, 200);


    }

    //bayan
    public function indexP($id)
    {

        $a = array();
        $i = 0;
        $descount = Discount::where('store_id', '=', $id)->get();

        foreach ($descount as $value) {
            if ($value->type == 1) {

                $a[$i] = discount_resource::make($value);
                $i += 1;

            }

        }
        return response()->json($a, 200);


    }

    //bayan
    public function delete(Request $request)
    {
        $collection = Discount::where('id', '=', $request->id)->first()->delete();
    }

}
