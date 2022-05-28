<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\BoshraRe\ProductResource;
use App\Models\SecondrayClassificationProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends BaseController
{

    public function index()
    {
        $ProductModel = Product::all();
        return response()->json($ProductModel, 200);
    }

    ////عرض منتج محدد
    public function show($id){
        $data = Product::where('id' , $id)->get();
        if ($data) {
            return $this->sendResponse(ProductResource::collection($data), 'تم ارجاع معلومات المنتج بنجاح');
        } else {
            return $this->sendErrors('خطأ في عرض معلومات المنتج', ['error' => 'error in show product info']);

        }
    }

    //////عرض منتجات مشابهة
    public function similar_products($id)
    {
        $my_classification = SecondrayClassificationProduct::where('product_id' , $id)->value('secondary_id') ;

        $products_class_ids = DB::table('secondray_classification_products')->where('secondary_id' , $my_classification)->where('product_id' , '!='  , $id)
        ->join('products', 'products.id', '=', 'secondray_classification_products.product_id')
        ->get();

        return $this->sendResponse($products_class_ids , "success");

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
