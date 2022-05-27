<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends BaseController
{

    public function index()
    {
        $ProductModel = Product::query()->get();
        return response()->json($ProductModel, 200);
    }

    ////عرض منتج محدد
    public function show(Request $request){
        $product = Product::find($request->product);
        return response()->json($product,200);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'discription' => 'nullable',
            'image' => 'required',
            'selling_price' => 'required',
            'cost_price' => 'required',
            'collection_id' => 'required',
            'return_or_replace' => 'required',
            'discount_products_id' => 'nullable',
            'prepration_time' => 'required',
            'gift' => 'nullable',
            'number_of_sales' => 'nullable',

            'party' => 'nullable',
            'age' => 'nullable',
        ]);


        $input = $request->all();
        $product = Product::create($input);

        if ($product) {
            foreach ($request->classification as $value) {
                SecondrayClassificationProductController::store($product->id, $value);
            }
            foreach ($request->type as $vv) {

                OptionTypeController::store($vv, $product->id, 0);

            }
            return $this->sendResponse($product, 'Store Shop successfully');

        } else {
            return $this->sendErrors('failed in Store Shop', ['error' => 'not Store Shop']);

        }

    }

    public function update(Request $request)
    {
        $product = Product::find($request->product);
        $product->update($request->all());

        if($request->classification){
            foreach ($request->classification as $value) {
                SecondrayClassificationProductController::update($product->id, $value);
            }
        }

        if ($request->type) {

            foreach ($request->type as $vv) {

                OptionTypeController::update($vv, $product->id);

            }


        }
        return $this->sendResponse($product, 'تم تعديل المجموعة بنجاح');
    }

    public function delete(Request $request){
        $product = Product::find($request->product)->delete();

    }

}
