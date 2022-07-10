<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\BoshraRe\ProductResource;
use App\Http\ResourcesBayan\collection_product;
use App\Http\ResourcesBayan\product_classification;
use App\Models\Collection;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CollectionController extends BaseController
{

    //عرض منتجات متجر محدد
    public function index($id)
    {


        $product = DB::table('products')
            ->join('collections', function ($join) use ($id) {
                $join->on('collections.id', '=', 'products.collection_id')
                    ->where('collections.store_id', '=', $id);
            })
            ->get();


        $g = product_classification::collection($product);

        return $this->sendResponse($g, 'Store Shop successfully');




//        $a = array();
//        $i = 0;
//        $collection = Collection::where('store_id', '=', $id)->get();
//        if ($collection) {
//
//            foreach ($collection as $option) {
//                $product = Product::where('collection_id', '=', $option->id)->get();
////                foreach ($product as $option1) {
////                      $a[$i] = $option1;
////                    $a[$i] = product_classification::collection($option1->id);
////
////                    $i = $i + 1;
////                }
//                $g = product_classification::collection($product);
//
//                $i = $i + 1;
//
//            }
//
//            return $this->sendResponse($g, 'Store Shop successfully');
//
//        } else {
//            return $this->sendErrors('failed in Store Shop', ['error' => 'not Store Shop']);
//
//        }





    }

    //عرض مجموعات متجر محدد
    public function collectionNane(int $id)
    {
        $collection = Collection::where('store_id', '=', $id)->get();
        if ($collection) {

            $g = collection_product::collection($collection);

            return response()->json($g,200);

        } else {
            return $this->sendErrors('failed in Store Shop', ['error' => 'not Store Shop']);

        }

    }

    // اضافة مجموعة
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
    public function update(Request $request)
    {
        $collection = Collection::find($request->id)->update($request->all());
        return $this->sendResponse($collection, 'تم تعديل المجموعة بنجاح');
    }

    //حذف مجموعة
    public function delete(Request $request)
    {
        $collection = Collection::find($request->id)->delete();
    }
}


