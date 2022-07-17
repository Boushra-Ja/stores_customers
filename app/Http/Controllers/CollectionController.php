<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\BoshraRe\ProductResource;
use App\Http\ResourcesBayan\collection_product;
use App\Http\ResourcesBayan\dashbord_resours;
use App\Http\ResourcesBayan\product_classification;
use App\Models\Collection;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CollectionController extends BaseController
{

    //عرض منتجات متجر محدد
    //bayan
    public static function index($id)
    {


//        $product = DB::table('products')
//            ->join('collections', function ($join) use ($id) {
//                $join->on('collections.id', '=', 'products.collection_id')
//                    ->where('collections.store_id', '=', $id);
//            })
//            ->get();

        $colection = Collection::where('store_id', '=', $id)->get();



        $i=0;
        $g2=array();
        foreach ($colection as $value){
            $product = Product::where('collection_id', '=', $value->id)->get();

            $g = product_classification::collection($product);
            foreach ($g as $v){
                $g2[$i]=$v;
                $i=$i+1;

            }
        }



        return $g2;


    }

    //عرض منتجات مجموعة محددة
    //bayan
    public function index2($id)
    {


        $product = Product::where('collection_id', '=', $id)->get();


        $g = product_classification::collection($product);

        return response()->json($g, 200);


    }

    //عرض مجموعات متجر محدد
    //bayan
    public function collectionNane(int $id)
    {
        $collection = Collection::where('store_id', '=', $id)->get();
        if ($collection) {

            $g = collection_product::collection($collection);

            return response()->json($g, 200);

        } else {
            return $this->sendErrors('failed in Store Shop', ['error' => 'not Store Shop']);

        }

    }

    // اضافة مجموعة
    //bayan
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'discription' => 'nullable',
            'image' => 'nullable',
            'store_id' => 'required',
        ]);

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('uploads/books/', $filename);
            $request->image = $filename;

        } else
            $request->image = '';


        $input = $request->all();
        $collection = Collection::create($input);

        if ($collection) {
            return $this->sendResponse($collection, 'Store Shop successfully');

        } else {
            return $this->sendErrors('failed in Store Shop', ['error' => 'not Store Shop']);

        }

    }

    // تعديل مجموعة
    //bayan
    public function update(Request $request)
    {
        $collection = Collection::where('id', '=', $request->id)->first()->update($request->all());
        return $this->sendResponse($collection, 'تم تعديل المجموعة بنجاح');
    }

    //حذف مجموعة
    //bayan
    public function delete(Request $request)
    {
        $collection = Collection::where('id', '=', $request->id)->first()->delete();
    }

    //مجموعة محددة
    //bayan
    public function show($id)
    {
        $collection = Collection::where('id', '=', $id)->first();
        if ($collection)
            return response()->json($collection, 200);
        else
            return $this->sendErrors('failed in Collection', ['error' => 'not Collection']);


    }

    //bayan
    public function dashbord ($id){

        return dashbord_resours::make($id);
    }



}


