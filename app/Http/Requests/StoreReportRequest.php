<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'content' => 'required' ,
            'store_id' => 'required|exists:stores,id',
            'customer_id' =>'required|exists:customers,id'
        ];
    }
}
