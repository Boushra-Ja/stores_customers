<?php

namespace App\Http\Controllers;

use App\Http\ResourcesBayan\my_stores_resors;
use App\Models\Persone;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreStoreRequest;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\BoshraRe\ProductClassResource;
use App\Http\Resources\BoshraRe\StoreResource;
use App\Models\Collection;
use App\Models\Product;

class StoreController extends BaseController
{

    ////عرض جميع المتاجر
    public function index()
    {
        $stores = Store::all();
        return $this->sendResponse(StoreResource::collection($stores), "تمت عملية عرض المتاجر بنجاح");
    }
     /////shop names
     public function shop_names()
     {
         $stores = Store::select('name as value' , 'id')->get();
         return $this->sendResponse($stores ,'success') ;
     }


    ////عرض المنتجات الأكثر تقييماً
    public function order_by_review()
    {
        $stores = DB::table('rating_stores')
            ->select([DB::raw("SUM(value) as value"), DB::raw("store_id"), DB::raw("count(value) as num_customer")])
            ->groupBy('store_id');

        $all_data = DB::table('stores')
            ->joinSub($stores, 'rating_stores', function ($join) {
                $join->on('stores.id', '=', 'rating_stores.store_id');
            })->select(['stores.*', 'rating_stores.*'])->get();

        if ($all_data) {
            return $this->sendResponse(StoreResource::collection($all_data), "تم إرجاع المتاجر من الأعلى تقييما الى الأقل تقييما");
        }
        return $this->sendErrors("مشكلة في ترتيب المتاجر");
    }

    ////عرض المنتجات الأكثر مبيعاً
    public function order_by_sales()
    {
        //[DB::raw('id' ),DB::raw('name' ),DB::raw('image' ),DB::raw('num_of_salling' )]
        $data = Store::select("*")->orderBy('num_of_salling', 'DESC')->get();
        return $this->sendResponse(StoreResource::collection($data), "تم ارجاع المتاجر حسب الاكثر مبيعاً");
    }

    /////انشاء متجر bayan
    public function store(StoreStoreRequest $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'discription' => ['required', 'string'],
            'delivery_area' => ['required', 'string'],
            'image',
            'Brand',
            'facebook',
            'mobile',
        ]);

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('uploads/books/', $filename);
            $request->image = $filename;

        } else
            $request->image = '';

        if ($request->hasfile('Brand')) {
            $file1 = $request->file('Brand');
            $extention1 = $file1->getClientOriginalExtension();
            $filename1 = time() . '.' . $extention1;
            $file1->move('uploads/books/', $filename1);
            $request->Brand = $filename1;

        } else
            $request->Brand = '';

        $input = $request->all();
        $shop = Store::create($input);


        if ($shop) {

            WaitingStoreController::store($shop->id);


            DiscountController::store($request, $shop->id, 1);

            $manager_id = StoreManagerController::register($request, $shop->id);
            return $this->sendResponse(['shop_id' => $shop->id, 'manager_id' => $manager_id], 'Store Shop successfully');
        } else {
            return $this->sendErrors('failed in Store Shop', ['error' => 'not Store Shop']);

        }

    }

     ////عرض متجر محدد
    public function show($id){
        $data = Store::where('id' , $id)->get();
        if ($data) {
            return $this->sendResponse(StoreResource::collection($data), 'تم ارجاع معلومات المتجر بنجاح');
        } else {
            return $this->sendErrors('خطأ في عرض معلومات المتجر', ['error' => 'error in show product info']);

        }
    }


    ////عرض متجر محدد
    /// bayan
    public function myshow($id)
    {
        $data = Store::where('id', $id)->get();
        if ($data) {
            return $this->sendResponse(my_stores_resors::collection($data), 'تم ارجاع معلومات المتجر بنجاح');
        } else {
            return $this->sendErrors('خطأ في عرض معلومات المتجر', ['error' => 'error in show store']);

        }
    }

    ////////تعديل بيانات المتجر
    /// bayan
    public function update(Request $request)
    {
        $persone = Persone::where('id', '=', $request->persone_id)->first();
        if ($persone)
            if ($persone->password == $request->old_password) {
                $store = Store::where('id','=',$request->store_id)->first()->update($request->all());
                StoreManagerController::update($request);
                return $this->sendResponse($store, 'تم تعديل ملف المتجر بنجاح');
            } else return $this->sendResponse("erorr", 'كلمة السر غير مطابقة');


    }

    ///جلب المنتجات مع تصنيفاتها
    public function product_with_class($store_id)
    {
        $collections_id = Collection::where('store_id', $store_id)->get();

        $pr = array();
        $i = 0;
        $res = array();
        $j = 0;
        foreach ($collections_id as $value) {
            $pr[$i] = DB::table('products')->where('products.collection_id', $value['id'])
                ->join('secondray_classification_products',  'products.id', '=',  'secondray_classification_products.product_id')
                ->join('secondray_classifications',  'secondray_classification_products.secondary_id', '=',  'secondray_classifications.id')
                ->join('classifications',  'classifications.id', '=',  'secondray_classifications.classification_id')
                ->select('secondray_classifications.id as secondary_id', 'secondray_classifications.title as secondray_title', 'secondray_classifications.classification_id as classification_id', 'classifications.title as classifications_title', 'products.*', 'secondray_classification_products.*')
                ->get();

            foreach ($pr[$i] as $val) {

                $res[$j] = $val;
                $j++;
            }
            $i++;
        }
        return $this->sendResponse(ProductClassResource::collection($res), 'success');
    }
    public function search_by_name($name)
    {
        $data = Store::query()
            ->where('name', 'LIKE',  '%' . $name . '%')
            ->get();
        if ($name == "")
            return $this->sendResponse(StoreResource::collection(Store::all()), 'success');


        return $this->sendResponse(StoreResource::collection($data), 'success');
    }
}
