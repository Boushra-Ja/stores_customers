<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Product;
use App\Models\SecondrayClassification;
use App\Models\SecondrayClassificationProduct;
use App\Http\Requests\StoreSecondrayClassificationProductRequest;
use App\Http\Requests\UpdateSecondrayClassificationProductRequest;
use Illuminate\Http\Request;

class SecondrayClassificationProductController extends BaseController
{
    public Static function store($product_id,$secondrayClassification_id)
    {
        $secondrayClassification=SecondrayClassification::find($secondrayClassification_id);
        $product=Product::find($product_id);

        $response=$secondrayClassification->product()->attach($product);

        return response()->json($response,200);
    }

    public Static function update($product_id,$secondrayClassification_id)
    {

        $secondrayClassification=SecondrayClassificationProduct::where('product_id','=',$product_id)->delete();

        SecondrayClassificationProductController::store($product_id,$secondrayClassification_id);

    }




}
