<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Collection;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateCollectionRequest;

class CollectionController extends BaseController
{

    public function index(){
        $collection = Collection::all();
        if ($collection) {
            return $this->sendResponse($collection, 'Store Shop successfully');

        } else {
            return $this->sendErrors('failed in Store Shop', ['error' => 'not Store Shop']);

        }

    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'discription' => 'nullable',
            'image' => 'nullable',
            'store_id' => 'required',
        ]);
        $input = $request->all();
        $collection = Collection::create($input);

        if ($collection) {
            return $this->sendResponse($collection, 'Store Shop successfully');

       } else {
            return $this->sendErrors('failed in Store Shop', ['error' => 'not Store Shop']);

        }

    }

    public function update(Request $request){
        $collection = Collection::find($request->collection)->update($request->all());
        return $this->sendResponse($collection, 'تم تعديل المجموعة بنجاح');
    }

    public function delete(Request $request){
        $collection = Collection::find($request->collection)->delete();

    }
}


