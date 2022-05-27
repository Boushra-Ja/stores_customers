<?php

namespace App\Http\Controllers;

use App\Models\OptioinValue;
use App\Http\Requests\StoreOptioinValueRequest;
use App\Http\Requests\UpdateOptioinValueRequest;

class OptioinValueController extends Controller
{
    public Static function store( $value,int $option_type_id)
    {
        OptioinValue::create([
            'value' => $value,
            'option_type_id' => $option_type_id
        ]);

    }
}
