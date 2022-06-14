<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\BoshraRe\ProductAllResource;
use App\Models\FavoriteProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoriteProductController extends BaseController
{
    //عرض مفضله المنتجات للزبون//
    public function Show_Favorite()
    {
//product_ratings
        $favorite=   DB::table('products')->select('*')
            ->join('favorite_products', 'favorite_products.product_id', '=', 'products.id')
            ->join('rating_products', 'rating_products.product_id', '=', 'products.id')
            ->get();
        /* DB::table('products')
         ->join('favorite_products', function ($join) {
             $join->on('products.id', '=', 'favorite_products.product_id')
                 ->where('favorite_products.customer_id', '=', 1);
         })
         ->get();*/
        return response(
            $favorite
        );

    }
    //اضافه لمفضله المنتجات//
    public function Add_Favorite($id)
    {
//        $product=Product::find($id);
//        $customer=auth :: id();
//        $response = $product-> favorite_products() ->attach($customer);
//        return response()->json($response,200);

 $v="delete_favorite";
 $c="add_to_favorite";
        $favorite=FavoriteProduct::where([
            'product_id'=> $id,
            'customer_id'=>1
        ])->first();
        if(!is_null($favorite)){
            $favorite->delete();
            return $v

            ;
        }
        else
        {
            FavoriteProduct::create([
                'customer_id'=>1,
                'product_id'=>$id
            ]);

            return
                $c
            ;

        }

    }


    //حدف مننج من مفضله المنتجات//
    public function Delete_Favorite($id)
    {
        $FavoriteProductModel = FavoriteProduct::findOrFail($id);
        $FavoriteProductModel -> delete();
    }


}
