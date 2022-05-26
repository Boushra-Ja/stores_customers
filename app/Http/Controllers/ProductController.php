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
        $ProductModel=Product::query()->get();
        return response()->json($ProductModel,200);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'prepration_time' => 'required',
            'party'=>'nullable',
            'discription'=>'nullable',
            'image' => 'required',
            'age'=>'nullable',
            'selling_price' => 'required',
            'cost_price' => 'required',
            'number_of_sales'=>'nullable',
            'return_or_replace' => 'required',
            'discount_products_id'=>'nullable',
            'collection_id' => 'required',
        ]);
        $input = $request->all();
        $product = Product::create($input);

        if ($product) {
            return $this->sendResponse($product, 'Store Shop successfully');

        } else {
            return $this->sendErrors('failed in Store Shop', ['error' => 'not Store Shop']);

        }

    }

    public function update(Request $request){
        $product = Product::find($request->product)->update($request->all());
        return $this->sendResponse($product, 'تم تعديل المجموعة بنجاح');
    }

    public function delete(Request $request){
        $product = Product::find($request->product)->delete();

    }

}
