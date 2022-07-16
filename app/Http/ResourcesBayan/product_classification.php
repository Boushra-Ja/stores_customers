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


        $i=0;
        $sec=array();
        $s=SecondrayClassificationProduct::where('product_id','=',$this->id)->get();
        foreach ($s as $value){
            $sec[$i]=SecondrayClassification::where('id','=',$value->secondary_id)->value('title');
            $i+=1;

        }
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
            'gift'=>$this->gift,
            'cost_price' => $this->cost_price,
            'return_or_replace' => $this->return_or_replace,
            'discount_products_id' => $this->discount_products_id,
            'classification'=> $sec,
            'collection'=> Collection::where('id','=',$this->collection_id)->value('title'),
            'review' => RatingResource::collection(ProductRating::where('product_id', $this->id)->get()),


        ];
    }
}
