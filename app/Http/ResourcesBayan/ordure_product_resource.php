<?php

namespace App\Http\ResourcesBayan;

use App\Models\OptioinValue;
use App\Models\OptionType;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class ordure_product_resource extends JsonResource
{

    public function toArray($request)
    {

        $a = array();
        $i = 0;

        $option_value = DB::table('optioin_values')->join('product_options', function ($join) {
            $join->on('product_options.option_values_id', '=', 'optioin_values.id')->where('product_options.order_product_id', '=', $this->order_id);
        })->get();

        foreach ($option_value as $v) {
            $option_type = OptionType::where('id', '=', $v->option_type_id)->first();
            if ($option_type->product_id == $this->product_id) {
                $a[$i] = [$v->value, $option_type->name];
                $i++;
            }
        }

        return [
            'id' => $this->product_id,
            'created_at' => $this->created_at->format('Y-m-d '),
            'updated_at' => $this->updated_at->format('Y-m-d '),
            'product' => Product::where('id', '=', $this->product_id)->value('name'),
            'option' => $a

        ];
    }
}
