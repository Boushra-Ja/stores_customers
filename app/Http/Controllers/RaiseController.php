<?php

namespace App\Http\Controllers;


use App\Models\Raise;
use Illuminate\Http\Request;

class RaiseController extends Controller
{
   public function store(Request $request){

       $raise=Raise::create([
           'price'=>$request->price,
           'date'=>$request->date,
           'status'=>$request->status,
           'product_id'=>$request->product_id,
       ]);
   }
}
