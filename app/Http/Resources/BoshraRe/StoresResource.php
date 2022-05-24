<?php

namespace App\Http\Resources\BoshraRe;

use App\Models\RatingStore;
use Illuminate\Http\Resources\Json\JsonResource;

class StoresResource extends JsonResource
{

    public function toArray($request)
    {
        return  [
            'store_id' => $this->id ,
            'shop_name' => $this->name ,
            'num_cell' => $this->num_of_salling ,
            'image' => $this->image ,
            'status' => $this->status ,
            'review' => RatingResource::collection(RatingStore::where('store_id' , $this->id)->get()) ,
        ];
}
}
