<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Classification;
use App\Http\Requests\StoreClassificationRequest;
use App\Http\Requests\UpdateClassificationRequest;
use App\Models\Product;
use App\Models\SecondrayClassification;
use App\Models\SecondrayClassificationProduct;
use Illuminate\Http\Request;

class ClassificationController extends BaseController
{


    //عرض التصنيفات
    //bayan
    public function Show_Classification()
    {
        $ClassificationModel = Classification::query()->get();
        $a = array();
        $i = 0;
        foreach ($ClassificationModel as $value) {
            $secundery = SecondrayClassification::where('classification_id', '=', $value->id)->get();
            $c = 0;

            foreach ($secundery as $t) {
                $product = SecondrayClassificationProduct::where('secondary_id', '=', $t)->get();
                $c += count($product);
            }
            $a[$i] = ["classification" => $value->title, "id" => $value->id, "secondrayClassification" => $secundery, "product" => $c];
        }
        return response()->json($a, 200);


    }

    // اضافة تصنيف
    //bayan
    public static function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
        ]);
        $classification = Classification::create([
            'title' => $request->title
        ]);


        if ($classification) {
            foreach ($request->secondray as $value) {
                SecondrayClassificationController::store($value, $classification->id);
            }
        }
    }

    //bayan
    public function update()
    {

    }


}
