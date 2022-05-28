<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Classification;
use App\Http\Requests\StoreClassificationRequest;
use App\Http\Requests\UpdateClassificationRequest;
use Illuminate\Http\Request;

class ClassificationController extends BaseController
{



    public function Show_Classification()
    {
        $ClassificationModel=Classification::query()->get();
        return response()->json($ClassificationModel,200);


    }
    public Static function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
        ]);
        $input = $request->all();
        $classification = Classification::create($input);


        if ($classification) {
            foreach ($request->id as  $value) {
                SecondrayClassificationController::store($value,$classification->id);
            }
        }
    }



}
