<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\OptioinValue;
use App\Http\Requests\StoreOptioinValueRequest;
use App\Http\Requests\UpdateOptioinValueRequest;

class OptioinValueController extends BaseController
{
    public static function options_type_with_value($type_id)
    {
        $values = OptioinValue::where('option_type_id' , $type_id)->get() ;
        return $values  ;

    }

    public Static function store( $value,int $option_type_id)
    {
        OptioinValue::create([
            'value' => $value,
            'option_type_id' => $option_type_id
        ]);

    }
}
