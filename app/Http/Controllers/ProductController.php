<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\FavoriteProduct;
use App\Models\Product;
use GuzzleHttp;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\BoshraRe\ProductResource;
use App\Models\SecondrayClassificationProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function MongoDB\BSON\fromJSON;
use function MongoDB\BSON\toJSON;

class ProductController extends BaseController
{

    //الاقل سعرا//
    public function Product_Order_Salary()/////
    {
        $ProductModel = Product::query()->
        //where('cost_price', '<', 50)->get();
         orderBy('cost_price', 'asc')->get();
       // paginate(3);
        return response()->json($ProductModel, 200);

        //http://127.0.0.1:8000/api/product/Display?page=2
    }

    //الاكثر شيوعا//
    public function Product_Order_sales()////////
    {
        $ProductModel = Product:: query() ->
        //where('number_of_sales', '>', 40)->get();
           orderBy('number_of_sales', 'desc')->get();
        //  paginate(3);
        return response()->json($ProductModel, 200);
    }

//العروض والحسومات//
    public function Product_Order_discount()
    {
        $discount = DB::table('discount_products')
            ->join('products', function ($join) {
                $join->on('discount_products.id', '=', 'products.discount_products_id')
                    ->where('discount_products.title', '=', 'null');
            })
            ->get();
        //->paginate(2);
        return response()->json($discount,200);
    }

    //اقتراحات قد تعجبك//
    public function Product_Order_favorite()
    {


        $pro = DB::table('secondray_classification_products')->select('*')
            ->join('favorite_products', 'favorite_products.product_id',
                '=', 'secondray_classification_products.product_id')
            ->get();


        $re = array();
        $i = 0;
        foreach ($pro as $val) {

            $prooo = DB::table('secondray_classification_products')
                ->join('products', 'products.id', '=', 'secondray_classification_products.product_id')
                ->where('secondray_classification_products.secondary_id', '=', $val->secondary_id)->get();
         //   $re[$i] =   $prooo;


        }
        foreach ($prooo as $value)
        {

            $re[$i] = $value;
            $i++;
           // echo "________________________________________________________";

        }


        return response()->json($re,200);

    }

//كل النتجات//
    public function Product_All()
    {
        $ProductModel = Product::query()->get();
        return response()->json($ProductModel, 200);
    }
    public function Product_Allf()
    {
        $ProductModel = FavoriteProduct::query()->get();
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
