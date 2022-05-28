<?php

namespace App\Http\Controllers;

use App\Models\FavoriteProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoriteProductController extends Controller
{
     //عرض مفضله المنتجات للزبون//
    public function Show_Favorite()
    {


        $favorite=DB::table('products')
            ->join('favorite_products', function ($join) {
                $join->on('products.id', '=', 'favorite_products.product_id')
                    ->where('favorite_products.customer_id', '=', Auth::id());
            })
            ->get();
        return response([
            "Data"=>$favorite
        ]);

    }

   //اضافه لمفضله المنتجات//
    public function Add_Favorite($id)
    {
//        $product=Product::find($id);
//        $customer=auth :: id();
//        $response = $product-> favorite_products() ->attach($customer);
//        return response()->json($response,200);


        $favorite=FavoriteProduct::where([
            'product_id'=> $id,
            'customer_id'=>Auth::id()
        ])->first();
        if(!is_null($favorite)){
            $favorite->delete();
            return response()->json([
                "message"=>"delete  favorite"
            ]);
        }
        else
        {
            FavoriteProduct::create([
                'customer_id'=>Auth::id(),
                'product_id'=>$id
            ]);

            return response()->json([
                "message"=>"add to favorite"
            ]);

        }

    }


    //حدف مننج من مفضله المنتجات//
    public function Delete_Favorite($id)
    {
        $FavoriteProductModel = FavoriteProduct::findOrFail($id);
        $FavoriteProductModel -> delete();
    }


}
