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

    //الاقل سعرا//
    public function Product_Order_Salary()
    {
        $ProductModel = Product::orderBy('cost_price', 'asc')->paginate(2);
        return response()->json($ProductModel, 200);

        //http://127.0.0.1:8000/api/product/Display?page=2
    }

    //الاكثر شيوعا//
    public function Product_Order_sales()
    {
        $ProductModel = Product::orderBy('number_of_sales', 'desc')->paginate(2);
        return response()->json($ProductModel, 200);
    }

//العروض والحسومات//
    public function Product_Order_discount()
    {
        $favorite = DB::table('products')
            ->join('discount_products', function ($join) {
                $join->on('discount_products.id', '=', 'products.discount_products_id')
                    ->where('discount_products.title', '=', 'null');
            })
            ->get();
        //->paginate(2);
        return response([
            $favorite
        ]);
    }

    //اقتراحات قد تعجبك//
    public function Product_Order_favorite()
    {

        $pro = DB::table('secondray_classification_products')->select('*')
            ->join('favorite_products', 'favorite_products.product_id', '=', 'classification_products.product_id')
            ->get();


        $re = array();
        $i = 0;
        foreach ($pro as $val) {

            $prooo = DB::table('secondray_classification_products')
                ->join('products', 'products.id', '=', 'classification_products.product_id')
                ->where('secondray_classification_products.secondary_id', '=', $val->secondary_id)->get();


            $re[$i] = $prooo;
            $i++;
        }

        return response($re, 200);


    }

//كل النتجات//
    public function Product_All()
    {
        $ProductModel = Product::query()->get();
        return response()->json($ProductModel, 200);
    }

    //تفاصيل منتج واحد//
    public function Show_Detalis($id)
    {
        $ProductModel = Product::query()->where('id', $id)->get();
        return response()->json($ProductModel, 200);
    }




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
