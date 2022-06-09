<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\OptionType;
use App\Http\Requests\StoreOptionTypeRequest;
use App\Http\Requests\UpdateOptionTypeRequest;
use App\Http\Resources\BoshraRe\OptionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OptionTypeController extends BaseController
{

    public function option_product($product_id)
    {
        $options = OptionType::where('product_id' , $product_id)->get() ;
        $values = DB::table('option_types')
        ->join('optioin_values', function ($join)  {
            $join->on('optioin_values.option_type_id', '=', 'option_types.id');

        })
        ->where('option_types.product_id' , $options[$product_id-1]['id'])
        ->get();

        return $this->sendResponse(OptionResource::collection($values) , "successs") ;
    }

    public static function store($type, int $product_id, int $i)
    {
        foreach ($type as $option) {
            if ($i == 0) {
                $optionType = OptionType::create([
                    'name' => $option,
                    'product_id' => $product_id
                ]);
                $i = $i + 1;
            } else if ($i == 1) {
                foreach ($option as $value) {
                    OptioinValueController::store($value, $optionType->id);
                }
            }


        }

    }

    public static function update($type, int $product_id)
    {

        $optionType = OptionType::where('product_id', '=', $product_id)->get();

        foreach ($optionType as $option) {
            $option->delete();
        }
        OptionTypeController::store($type, $product_id,0);

    }


}
