<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\BoshraRe\ProductAllResource;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\FavoriteProduct;
use App\Models\ProductRating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoriteProductController extends BaseController
{
    //عرض مفضله المنتجات للزبون مع التقيمات //
    public function index()
    {


        $favorite = DB::table('favorite_products')
            ->join('products', 'products.id', '=', 'favorite_products.product_id'

            )
            ->get();

        if ($favorite) {
            return

                ProductAllResource::collection($favorite);
        } else {
            return "null";
        }
        //  return $favorite;
    }


    //اضافه لمفضله المنتجات او حذف  //
    public function store($id)
    {

        $v = "delete_favorite";
        $c = "add_to_favorite";
        $favorite = FavoriteProduct::where([
            'product_id' => $id,
            'customer_id' => 1
        ])->first();
        if (!is_null($favorite)) {
            $favorite->delete();
            return $v;
        }
        else {
            FavoriteProduct::create([
                'customer_id' => 1,
                'product_id' => $id
            ]);

            return
                $c;

        }

    }


    public function show(){

        $e=FavoriteProduct::query()->get(['product_id','id']);
       return response()->json($e,200);
    }


    //حدف مننج من مفضله المنتجات//
    public function destroy($id)
    {
        $FavoriteProductModel = FavoriteProduct::findOrFail($id);
        $FavoriteProductModel -> delete();
    }


    public function isFavourite($product_id , $customer_id)
    {

        $check = FavoriteProduct::where('customer_id' , $customer_id)->where('product_id' , $product_id)->first()  ;

        if($check)
            return 1 ;
        else
            return 0 ;
    }


}
