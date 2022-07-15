<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\BoshraRe\ProductAllResource;
use App\Http\Resources\BoshraRe\ProductResource;
use App\Models\Collection;
use App\Models\OptioinValue;
use App\Models\OptionType;
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

    public function search_by_name($name)
    {
        $data = Product::query()
        ->where('name', 'LIKE',  '%' . $name . '%')
        ->get() ;
        return $data ;
    }

    public function Gift_request($party , $fromage , $toage, $material , $fromprice , $toprice)
    {
        $data4 = array() ;
        $data5 = array() ;
        $res = array() ;
        $k = 0;
        $i = 0;
        $j = 0;
        if($material!='null')
        {
            $data = OptioinValue::query()
            ->where('value' , $material)
            ->get() ;

            foreach ($data as $value) {

                $data4[$i] = OptionType::where('id' , $value['option_type_id'])->get() ;

                foreach ($data4[$i] as $val){
                    if($party != " " && $fromage != '0' && $toage != '0' && $fromprice != '0' && $toprice != '0'){
                        $data5[$j]=Product::where('id' , $val['product_id'])
                        ->where('party', 'LIKE',  '%' . $party . '%')
                        ->where('age'  ,'>=' , $fromage)
                        ->where('age'  ,'<='  , $toage)
                        ->where('selling_price'  ,'>=' , $fromprice)
                        ->where('selling_price'  ,'<='  , $toprice)
                        ->get();
                    }
                    else if($party == " " && $fromage == '0' && $toage == '0' && $fromprice == '0' && $toprice == '0'){
                        $data5[$j]=Product::where('id' , $val['product_id']) ->get();
                    }

                    else if($party == " " && $fromage != '0' && $toage != '0' && $fromprice != '0' && $toprice != '0')
                    {
                        $data5[$j]=Product::where('id' , $val['product_id'])
                        ->where('age'  ,'>=' , $fromage)
                        ->where('age'  ,'<='  , $toage)
                        ->where('selling_price'  ,'>=' , $fromprice)
                        ->where('selling_price'  ,'<='  , $toprice)
                        ->get();
                    }
                    else if($party != " " && $fromage == '0' && $toage == '0' && $fromprice == '0' && $toprice == '0')
                    {
                        $data5[$j]=Product::where('id' , $val['product_id'])
                        ->where('party', 'LIKE',  '%' . $party . '%')
                        ->get();
                    }
                    else if($party == " " && $fromage == "0" && $toage == "0" )
                    {
                        $data5[$j]=Product::where('id' , $val['product_id'])
                        ->where('selling_price'  ,'>=' , $fromprice)
                        ->where('selling_price'  ,'<='  , $toprice)
                        ->get();
                    }
                    else if($party == " " && $fromprice == "0" && $toprice == "0" )
                    {
                        $data5[$j]=Product::where('id' , $val['product_id'])
                        ->where('age'  ,'>=' , $fromage)
                        ->where('age'  ,'<='  , $toage)
                        ->get();
                    }

                    else if($party != " " && $fromage == "0" && $toage == "0" )
                    {
                        $data5[$j]=Product::where('id' , $val['product_id'])
                        ->where('party', 'LIKE',  '%' . $party . '%')
                        ->where('selling_price'  ,'>=' , $fromprice)
                        ->where('selling_price'  ,'<='  , $toprice)
                        ->get();
                    }
                    else if($party != " " && $fromprice == "0" && $toprice == "0" )
                    {
                        $data5[$j]=Product::where('id' , $val['product_id'])
                        ->where('party', 'LIKE',  '%' . $party . '%')
                        ->where('age'  ,'>=' , $fromage)
                        ->where('age'  ,'<='  , $toage)
                        ->get();
                    }


                    foreach ($data5[$j] as $v) {
                        $res[$k] = $v ;
                        $k++ ;
                    }
                    $j++;

                }
                $i++;
            }
        }
        else
        {
            if($party != " " && $fromage != '0' && $toage != '0' && $fromprice != '0' && $toprice != '0'){
                $data5[$j]=Product::where('party', 'LIKE',  '%' . $party . '%')
                ->where('age'  ,'>=' , $fromage)
                ->where('age'  ,'<='  , $toage)
                ->where('selling_price'  ,'>=' , $fromprice)
                ->where('selling_price'  ,'<='  , $toprice)
                ->get();
            }
            else if($party == " " && $fromage == '0' && $toage == '0' && $fromprice == '0' && $toprice == '0'){
                $data5[$j]=Product::all();
            }

            else if($party == " " && $fromage != '0' && $toage != '0' && $fromprice != '0' && $toprice != '0')
            {
                $data5[$j]=Product::where('age'  ,'>=' , $fromage)
                ->where('age'  ,'<='  , $toage)
                ->where('selling_price'  ,'>=' , $fromprice)
                ->where('selling_price'  ,'<='  , $toprice)
                ->get();
            }
            else if($party != " " && $fromage == '0' && $toage == '0' && $fromprice == '0' && $toprice == '0')
            {
                $data5[$j]=Product::where('party', 'LIKE',  '%' . $party . '%')
                ->get();
            }
            else if($party == " " && $fromage == "0" && $toage == "0" )
            {
                $data5[$j]=Product::where('selling_price'  ,'>=' , $fromprice)
                ->where('selling_price'  ,'<='  , $toprice)
                ->get();
            }
            else if($party == " " && $fromprice == "0" && $toprice == "0" )
            {
                $data5[$j]=Product::where('age'  ,'>=' , $fromage)
                ->where('age'  ,'<='  , $toage)
                ->get();
            }

            else if($party != " " && $fromage == "0" && $toage == "0" )
            {
                $data5[$j]=Product::where('party', 'LIKE',  '%' . $party . '%')
                ->where('selling_price'  ,'>=' , $fromprice)
                ->where('selling_price'  ,'<='  , $toprice)
                ->get();
            }
            else if($party != " " && $fromprice == "0" && $toprice == "0" )
            {
                $data5[$j]=Product::where('party', 'LIKE',  '%' . $party . '%')
                ->where('age'  ,'>=' , $fromage)
                ->where('age'  ,'<='  , $toage)
                ->get();
            }
            foreach ($data5[$j] as $v) {
                $res[$k] = $v ;
                $k++ ;
            }

        }
        return $this->sendResponse(ProductResource::collection($res) , 'success');

    }


}
