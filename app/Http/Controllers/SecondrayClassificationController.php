<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\SecondrayClassification;
use App\Http\Requests\StoreSecondrayClassificationRequest;
use App\Http\Requests\UpdateSecondrayClassificationRequest;
use Illuminate\Http\Request;

class SecondrayClassificationController extends BaseController
{
    public static function store(string $title, int $id)
    {

         SecondrayClassification::create([
            'title' => $title,
            'classification_id' => $id
        ]);

    }

}
