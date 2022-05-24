<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Collection;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateCollectionRequest;

class CollectionController extends BaseController
{

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
//
        if ($collection) {
            return $this->sendResponse($collection, 'Store Shop successfully');

       } else {
            return $this->sendErrors('failed in Store Shop', ['error' => 'not Store Shop']);

        }

    }
}


