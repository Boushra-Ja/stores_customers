<?php

namespace App\Http\ResourcesBayan;

use App\Http\Resources\BoshraRe\RatingResource;
use App\Models\Collection;
use App\Models\ProductRating;
use App\Models\SecondrayClassification;
use App\Models\SecondrayClassificationProduct;
use App\Models\Store;
use Illuminate\Http\Resources\Json\JsonResource;

class product_classification extends JsonResource
{

    public function toArray($request)
    {


        return  [
            'product_id' => $this->id,
            'product_name' => $this->name,
            'image' => $this->image,
            'selling_price' => $this->selling_price,
            'num_cell' => $this->number_of_sales,
            'prepration_time' => $this->prepration_time,
            'party' => $this->party,
            'discription' => $this->discription,
            'age' => $this->age,
            'cost_price' => $this->cost_price,
//            'created_at' => $this->created_at->format('Y-m-d '),
//            'updated_at' => $this->updated_at->format('Y-m-d '),
            'return_or_replace' => $this->return_or_replace,
            'discount_products_id' => $this->discount_products_id,
          //  'classification'=> SecondrayClassification::where('id','=',SecondrayClassificationProduct::where('id','=',$this->id)->value('id'))->get()->value('title'),
            'collection'=> Collection::where('id','=',$this->collection_id)->value('title'),

        ];
    }
}
