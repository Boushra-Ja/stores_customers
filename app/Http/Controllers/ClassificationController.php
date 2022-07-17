<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Classification;
use App\Http\Requests\StoreClassificationRequest;
use App\Http\Requests\UpdateClassificationRequest;
use Illuminate\Http\Request;

class ClassificationController extends BaseController
{


    //عرض التصنيفات
    public function Show_Classification()
    {
        $ClassificationModel=Classification::query()->get();
        return response()->json($ClassificationModel,200);


    }

    // اضافة تصنيف
    //bayan
    public Static function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
        ]);
        $classification = Classification::create([
            'title'=>$request->title
        ]);


        if ($classification) {
            foreach ($request->secondray as  $value) {
                SecondrayClassificationController::store($value,$classification->id);
            }
        }
    }





}
