<?php

namespace App\Http\Controllers;
use App\Models\Classification;
use App\Models\SecondrayClassification;
use Illuminate\Support\Facades\DB;

class SecondrayClassificationController extends Controller
{

    public function Show_Secondray()
    {


       return response()->json(Classification::with('secondary_classifications')->get());

    }





    public function ShowClassification(int $id, String $title)
    {
        //الاكثر شيوعا//
        if ($id == '1') {
            $SecondrayModel = SecondrayClassification::query()->where('title', $title)->get()->pluck('id');
            $pro = DB::table('classification_products')
                ->orderBy('products.number_of_sales', 'desc')
                ->join('products', function ($join) use ($SecondrayModel) {
                    $join->on('products.id', '=', 'classification_products.product_id')
                        ->where('classification_products.secondary_classification_id', '=', $SecondrayModel[0]);
                })
                ->get();
            return response($pro, 200);

        }

        //الاقل سعرا//
        if ($id == 2) {
            $SecondrayModel = SecondrayClassification::query()->where('title', $title)->get()->pluck('id');
            $pro = DB::table('classification_products')
                ->orderBy('products.cost_price', 'asc')
                ->join('products', function ($join) use ($SecondrayModel) {
                    $join->on('products.id', '=', 'classification_products.product_id')
                        ->where('classification_products.secondary_classification_id', '=', $SecondrayModel[0]);
                })
                ->get();
            return response($pro, 200);


        }

        //العروض والخصومات//
        if ($id == '3') {
            $SecondrayModel = SecondrayClassification::query()->where('title', $title)->get()->pluck('id');
            $pro = DB::table('products')
                ->join('discount_products', function ($join) use ($SecondrayModel) {
                    $join->on('discount_products.id', '=', 'products.discount_products_id')
                        ->where('discount_products.title', '=', 'null')
                        ->where('classification_products.secondary_classification_id', '=', $SecondrayModel[0]);
                })
                ->get();
            return response($pro, 200);

        }

        //اقتراحات قد تعجبك//
        if ($id == '4') {
            $SecondrayModel = SecondrayClassification::query()->where('title', $title)->get()->pluck('id');

            $pro = DB::table('classification_products')->select('*')
                ->join('favorite_products', 'favorite_products.product_id', '=', 'classification_products.product_id')
                ->where('classification_products.secondary_classification_id', '=', $SecondrayModel[0])
                ->get();


            $re = array();
            $i = 0;
            foreach ($pro as $val) {

                $prooo = DB::table('classification_products')
                    ->join('products', 'products.id', '=', 'classification_products.product_id')
                    ->where('classification_products.secondary_classification_id', '=', $val->secondary_classification_id)->get();


                $re[$i] = $prooo;
                $i++;
            }


            return response($re, 200);


        }


    }




}
