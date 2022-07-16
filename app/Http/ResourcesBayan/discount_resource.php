<?php

namespace App\Http\ResourcesBayan;

use App\Models\Collection;
use App\Models\DiscountProduct;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class discount_resource extends JsonResource
{

    public function toArray($request)
    {

        $products = array();
        $i = 0;
        $product = DiscountProduct::where('discounts_id', '=', $this->id)->first();
        if ($product->apply_to == 'p') {
            $p = Product::where('discount_products_id', '=', $product->id)->get();
            foreach ($p as $v) {
                $products[$i] = $v->id;
                $i += 1;

            }
        } else if ($product->apply_to == 'c') {
            $p = Product::where('discount_products_id', '=', $product->id)->get();
            $d = $p->groupBy('collection_id');
            foreach ($d as $value) {
                foreach ($value as $v) {
                    $products[$i] = $v->collection_id;
                    $i += 1;
                    break;

                }
            }
        }


        return [
            'id' => $product->id,
            'discounts_id' => $this->id,
            'type' => $this->type,
            'value' => $this->value,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'title' => $product->title,
            'apply_to' => $product->apply_to,
            'products' => $products,

        ];
    }
}
