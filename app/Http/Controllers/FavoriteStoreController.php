<?php

namespace App\Http\Controllers;

use App\Models\FavoriteStore;
use App\Http\Requests\StoreFavoriteStoreRequest;
use App\Http\Requests\UpdateFavoriteStoreRequest;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoriteStoreController extends Controller
{

    //عرض مفضله المتاجر للزبون//
    public function Show_Favorite()
    {


        $favorite=DB::table('stores')
            ->join('favorite_stores', function ($join) {
                $join->on('stores.id', '=', 'favorite_stores.store_id')
                    ->where('favorite_stores.customer_id', '=', 1);
            })
            ->get();
        return response(
            $favorite
        );



    }

    //اضافه لمفضله المتاجر//
    public function Add_Favorite($id)
    {

        $store=Store::find($id);
        $customer=auth :: id();
        $response = $store-> favourits() ->attach($customer);
        return response()->json($response,200);



//        $favorite=FavoriteStore::where([
//            'store_id'=> $id,
//            'customer_id'=>Auth::id()
//        ])->first();
//        if(!is_null($favorite)){
//            $favorite->delete();
//            return response()->json([
//                "message"=>"delete  favorite"
//            ]);
//        }
//        else
//        {
//            FavoriteStore::create([
//                'store_id'=>Auth::id(),
//                'product_id'=>$id
//            ]);
//
//            return response()->json([
//                "message"=>"add to favorite"
//            ]);
//
//        }

    }


    //حدف مننج من مفضله المتاجر//
    public function Delete_Favorite($id)
    {
        $FavoriteStoreModel = FavoriteStore::findOrFail($id);
        $FavoriteStoreModel -> delete();
    }




//    public function Show_Favorite()
//    {
//
//        $FavoriteStoreModel=FavoriteStore::query()->where('customer_id', auth::id())->get();
//        return response()->json(  $FavoriteStoreModel,200);
//
//
//    }









}
