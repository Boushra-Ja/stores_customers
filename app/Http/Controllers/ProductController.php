<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\BoshraRe\ProductAllResource;
use App\Http\Resources\BoshraRe\ProductResource;
use App\Models\Collection;
use App\Models\SecondrayClassificationProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends BaseController
{

    //الاقل سعرا//
    public function Order_Salary()
    {
        $ProductModel = Product::orderBy('cost_price', 'asc')->get();
        // all();
        //orderBy('cost_price', 'asc')->get() ;


        return response()->json($ProductModel, 200);

    }

    //الاكثر شيوعا//
    public function Order_sales()
    {
        $ProductModel = Product::orderBy('number_of_sales', 'desc')->get() ;
        return response()->json($ProductModel, 200);
    }

    //العروض والحسومات//
    public function Order_discount()
    {
        $favorite = DB::table('products')
            ->join('discount_products', function ($join) {
                $join->on('discount_products.id', '=', 'products.discount_products_id')
                    ->where('discount_products.title', '=', 'null');
            })
            ->get();

        return response(
            $favorite
        );
    }

    //اقتراحات قد تعجبك//
    public function Order_favorite()
    {
//
        $re = array();
        $i = 0;
//        $prooo=array();

        $pro = DB::table('secondray_classification_products')
            ->join('favorite_products', 'favorite_products.product_id', '=', 'secondray_classification_products.product_id')
            ->get();



        foreach ($pro as $val) {
            $prooo = DB::table('secondray_classification_products')
                ->join('products', 'products.id', '=', 'secondray_classification_products.product_id')

                ->where('secondray_classification_products.secondary_id', '=', $val->secondary_id)->get();
            foreach ($prooo as $valk) {

                $re[$i]=$valk;
                $i++;
            }
        }


        //  echo $prooo[0];

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
            return $this->sendResponse(ProductAllResource::collection($data), 'تم ارجاع معلومات المنتج بنجاح');
        } else {
            return $this->sendErrors('خطأ في عرض معلومات المنتج', ['error' => 'error in show product info']);

        }
    }

    //////عرض منتجات مشابهة
    public function similar_products($id)
    {
        $my_classification = SecondrayClassificationProduct::where('product_id' , $id)->get() ;

        $products_class_ids = array() ;
        $i = 0;
        $res = array() ;
        $j = 0;
        foreach ($my_classification as $value) {
            $products_class_ids[$i] = DB::table('secondray_classification_products')->where('secondary_id' , $value['secondary_id'])->where('product_id' , '!='  , $id)
            ->join('products', 'products.id', '=', 'secondray_classification_products.product_id')
            ->get();

            foreach ($products_class_ids[$i] as $val) {
                $res[$j] = $val ;
                $j++;
            }
            $i++;
    }


        return $this->sendResponse( ProductResource::collection($res) , "success");
    }

    // اضافة منتج
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

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('uploads/books/', $filename);
            $request->image = $filename;

        } else
            $request->image = '';


//        $i=CollectionController::getCollectionId($request->collection_name);
//        $request->collection_id=$i;

        $input = $request->all();
        $product = Product::create($input);

        if ($product) {
            foreach ($request->classification as $value) {
                SecondrayClassificationProductController::store($product->id, $value);
            }
//            foreach ($request->type as $vv) {
//
//                OptionTypeController::store($vv, $product->id, 0);
//
//            }
            return $this->sendResponse($product, 'Store Shop successfully');

        } else {
            return $this->sendErrors('failed in Store Shop', ['error' => 'not Store Shop']);

        }

    }

    // تعديل منتج
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

    //حذف منتج
    public function delete(Request $request){
        $product = Product::find($request->product)->delete();

    }



    public function temp(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'party' => 'nullable',
            'discription'  => 'required',
            'image' => 'required',
            'selling_price' => 'required',
            'cost_price' => 'required',
            'collection_id' => 'required',
            'return_or_replace' => 'required',
            'discount_products_id' => 'required',
            'prepration_time' => 'required',
            'gift'=> 'required',
            'number_of_sales' => 'required',
            'age' => 'required',
        ]);
        $product = new Product();
        $product->name =$request->name;
        $product->discription = $request->discription;
        $product->age =$request->age;
        $product->gift = $request->gift;
        $product->prepration_time = $request->prepration_time;
        $product->discount_products_id = $request->discount_products_id;
        $product->return_or_replace = $request->return_or_replace;
        $product->collection_id = $request->collection_id;
        $product->number_of_sales = $request->number_of_sales;
        $product->cost_price =$request->cost_price;
        $product->selling_price =$request->selling_price;
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/product/', $filename);
            $product->image =$filename;

        }
        else
            $product->image ='';
        $product->save();


        if ($product) {
//            foreach ($request->classification as $value) {
//                SecondrayClassificationProductController::store($product->id, $value);
//            }
//            foreach ($request->type as $vv) {
//
//                OptionTypeController::store($vv, $product->id, 0);
//
//            }
            return $this->sendResponse($product, 'Store Shop successfully');

        } else {
            return $this->sendErrors('failed in Store Shop', ['error' => 'not Store Shop']);

        }

    }


    public function my_product($store_id)
    {

        $collections_id = Collection::where('store_id' , $store_id)->get();
        $product = array() ;
        $i =0 ;
        $j = 0 ;
        $res = array() ;

        foreach ($collections_id as  $value) {

            $product[$i] = Product::where('collection_id' , $value['id']) ->get();

            foreach ($product[$i] as  $val) {
                $res[$j] = $val ;
                $j = $j + 1 ;
            }
            $i = $i + 1 ;
        }

        return $this->sendResponse(ProductResource::collection($res) , 'success') ;

    }
}
