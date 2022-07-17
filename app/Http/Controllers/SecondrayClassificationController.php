<?php

namespace App\Http\Controllers;
use App\Models\Classification;
use App\Models\SecondrayClassification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SecondrayClassificationController extends Controller
{

    public function Show_Secondray()
    {
        return response()->json(Classification::with('secondary_classifications')->get());

    }

    public function Show_p()
    {

        $classificationModel = Classification::query()->get();

        return response()->json($classificationModel, 200);

    }

    public function ShowClassification(int $id, String $title)
    {
        //الاكثر شيوعا//
        if ($id == '1') {
            $SecondrayModel = SecondrayClassification::query()->where('title', $title)->get()->pluck('id');
            $pro = DB::table('secondray_classification_products')
                ->orderBy('products.number_of_sales', 'desc')
                ->join('products', function ($join) use ($SecondrayModel) {
                    $join->on('products.id', '=', 'secondray_classification_products.product_id')
                        ->where('secondray_classification_products.secondary_id', '=', $SecondrayModel[0]);
                })
                ->get();
            return response($pro, 200);

        }

        //الاقل سعرا//
        if ($id == 2) {
            $SecondrayModel = SecondrayClassification::query()->where('title', $title)->get()->pluck('id');
            $pro = DB::table('secondray_classification_products')
                ->orderBy('products.cost_price', 'asc')
                ->join('products', function ($join) use ($SecondrayModel) {
                    $join->on('products.id', '=', 'secondray_classification_products.product_id')
                        ->where('secondray_classification_products.secondary_id', '=', $SecondrayModel[0]);
                })
                ->get();
            return response($pro, 200);


        }

        //العروض والخصومات//
        if ($id == '3') {
            $SecondrayModel = SecondrayClassification::query()->where('title', $title)->get()->pluck('id');
            $pro = DB::table('discount_products')
                ->join('products', function ($join) use ($SecondrayModel) {
                    $join->on('discount_products.id', '=', 'products.discount_products_id')
                        ->where('discount_products.title', '=', 'null');
                     // ->where('secondray_classification_products.secondary_id', '=', $SecondrayModel[0]);
                })
                ->get();
            return response($pro, 200);

        }

       // اقتراحات قد تعجبك//
        if ($id == '4') {
            $SecondrayModel = SecondrayClassification::query()->where('title', $title)->get()->pluck('id');

            $pro = DB::table('secondray_classification_products')->select('*')
                ->join('favorite_products', 'favorite_products.product_id', '=', 'secondray_classification_products.product_id')
                ->where('secondray_classification_products.secondary_id', '=', $SecondrayModel[0])
                ->get();


            foreach ($pro as $val) {
                $prooo = DB::table('secondray_classification_products')
                    ->join('products', 'products.id', '=', 'secondray_classification_products.product_id')

                    ->where('secondray_classification_products.secondary_id', '=', $val->secondary_id)->get();
                foreach ($prooo as $valk) {

                    $re[$i]=$valk;
                    $i++;
                }
            }


            return response($re, 200);


        }


    }

    public Static function show_product($secondrayClassification){
        $a=array();
        $i=0;
        foreach ($secondrayClassification as $option){
            $data=SecondrayClassification::where('id','=',$option->secondary_id)->first();
            $a[$i]=$data;
            $i=$i+1;
        }

        return $a;
    }

    public function ShowClassification2($id)
    {

        // $SecondrayModel = SecondrayClassification::query()->get()->pluck('id');
        $pro = DB::table('classifications')
            ->join('secondray_classifications', function ($join) use ($id)   {

                $join->on('classifications.id', '=', 'secondray_classifications.classification_id')

                    ->where('secondray_classifications.classification_id', '=',  $id);
            })
            ->get();
        return response($pro, 200);



        // return SecondrayClassification::with('classification')->Select('secondray_classifications.title','classifications.title')->get();




    }

    //bayan
    public static function store($value,$id){

        SecondrayClassification::create([
            'title'=>$value,
            'classification_id'=>$id,
        ]);
    }

    //bayan
    public function list_seconderay(){
        $secoundry=SecondrayClassification::all();
        return response()->json($secoundry, 200);
    }
}
