<?php

namespace App\Http\Controllers;

use App\Models\OptionType;
use App\Http\Requests\StoreOptionTypeRequest;
use App\Http\Requests\UpdateOptionTypeRequest;
use Illuminate\Http\Request;

class OptionTypeController extends Controller
{

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
