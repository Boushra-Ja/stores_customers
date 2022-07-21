<?php

namespace App\Http\Resources\BoshraRe;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreTasneemResource extends JsonResource
{

    public function toArray($request)
    {
        return  [
            'store_id' => $this->store_id ,
            'shop_name' => $this->name ,
            'discription' => $this->discription ,
            'status' => $this->status ,
            'email' => $this->email
        ];
    }
}
