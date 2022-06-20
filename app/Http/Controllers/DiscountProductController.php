<?php

namespace App\Http\Controllers;

use App\Models\DiscountProduct;
use App\Http\Requests\StoreDiscountProductRequest;
use App\Http\Requests\UpdateDiscountProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class DiscountProductController extends Controller
{
    public static function store(Request $request, $id){
        $request->validate([
            'title'=> 'nullable',
            'apply_to'=> 'required',
        ]);


        $input = $request->all();
        $discount = DiscountProduct::create([
            'title'=> $request->title,
            'apply_to'=> $request->apply_to,
            'discounts_id'=> $id,
        ]);

        if ($discount) {

            foreach ($request->product as $value){
                $product = Product::find($value)->update(['discount_products_id' => $discount->id,]);

            }


        }
    }
}
