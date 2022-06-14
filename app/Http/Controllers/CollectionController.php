<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\BoshraRe\ProductResource;
use App\Models\Collection;
use App\Models\Product;
use Illuminate\Http\Request;


class CollectionController extends BaseController
{

    //عرض منتجات متجر محدد
    public function index($id)
    {
        $a = array();
        $i = 0;
        $collection = Collection::where('store_id', '=', $id)->get();
        if ($collection) {

            foreach ($collection as $option) {
                $product = Product::where('collection_id', '=', $option->id)->get();
                foreach ($product as $option1) {
                    $a[$i] = $option1;
                    $i = $i + 1;
                }

            }

            return $this->sendResponse($a, 'Store Shop successfully');

        } else {
            return $this->sendErrors('failed in Store Shop', ['error' => 'not Store Shop']);

        }

    }

    //عرض مجموعات متجر محدد
    public function collectionNane(int $id)
    {
        $collection = Collection::where('store_id', '=', $id)->get();
        if ($collection) {

            return $this->sendResponse($collection, 'Store Shop successfully');

        } else {
            return $this->sendErrors('failed in Store Shop', ['error' => 'not Store Shop']);

        }

    }

    // اضافة مجموعة
    public function store(Request $request)
    {
        // dd(auth::id());
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


