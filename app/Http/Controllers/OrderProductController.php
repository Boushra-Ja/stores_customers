<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Http\ResourcesBat\OrderCollectionB;
use App\Http\ResourcesBayan\mybill_resorce;
use App\Http\ResourcesBayan\ordure_product_resource;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Http\Requests\StoreOrderProductRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderProductRequest;
use App\Http\Resources\BoshraRe\BillResource;
use App\Http\Resources\BoshraRe\OrderProductResource;
use App\Http\Resources\BoshraRe\ProductBillResource;
use App\Models\OrderStatus;
use App\Models\Persone;
use App\Models\Product;
use App\Models\StoreManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderProductController extends BaseController
{


    ////////التأكد أن الطلب في السلة
    //boshra
    public function check_of_order($product_id, $order_id)
    {
        $data = OrderProduct::where('product_id', $product_id)->where('order_id', $order_id)->where('status_id', OrderStatus::where('status', 'في السلة')->value('id'))->first();
        if ($data) {
            return  1;
        }
        return 0;
    }


            // سله المشتريات//
    public function index()
    {
        $status_id = OrderStatus::where('status', "في السلة")->value('id');

        $order=OrderProduct::query()->where('status_id',$status_id)->orderBy('order_id', 'asc')->get();

        if ($order) {
            return

                OrderCollectionB::collection($order);
        } else {


            return null;
        }

        /////////////////////////////////

    }


     //تحويل  الطلب لمعلق//
    public function  ChangeToCommit($orderid,$productid){

        $status_id = OrderStatus::where('status', "في السلة")->value('id');
        $order = OrderProduct::find($orderid);



        if( $order )
            if( $order->order_id==$orderid && $order->product_id==$productid && $order->status_id==5 )
            {

                $order2 = DB::table('order_products')
                    ->join('orders', 'orders.id', '=', 'order_products.order_id'
                    )->where('status_id',$status_id)
                    ->where('orders.id',$orderid)
                    ->where('order_products.product_id',$productid)->get()->value('customer_id');

                if( $order2==1/*Auth::id()*/)
                { $order->status_id = 1;//معلق 1//
                    $order->save();

                }
//                else
//                    echo 'noooo';
            }



    }
    //تعديل كميه الطلب//
    public function  ChangeAmount($productid,$orderid,$amount){

        $status_id = OrderStatus::where('status', 'في السله')->value('id');
        $order = OrderProduct::find($orderid);



        if( $order )
            if( $order->order_id==$orderid && $order->product_id==$productid && $order->status_id==5 )
            {

                $order2 = DB::table('order_products')
                    ->join('orders', 'orders.id', '=', 'order_products.order_id'
                    )->where('status_id',$status_id)
                    ->where('orders.id',$orderid)
                    ->where('order_products.product_id',$productid)->get()->value('customer_id');

                if( $order2==1/*Auth::id()*/)
                { $order->amount =$amount ;
                    $order->save();

                }
//                else
//                    echo 'noooo';
        }



    }

    //////اضافة المنتج الى السلة
    ///boshra
    public function store(StoreOrderProductRequest $request)
    {

        $orderProduct = OrderProduct::Create([
            'product_id' => $request->product_id,
            'status_id' => OrderStatus::where('status', 'في السلة')->value('id'),
            'order_id' => $request->order_id,
            'amount' => $request->amount,
            "gift_order" => $request->gift_order,
            "discount_products_id" => Product::where('id' , $request->product_id)->value('discount_products_id')
        ]);

        $arr = [$orderProduct];

        if ($arr) {
            return $this->sendResponse(OrderProductResource::collection($arr), "success");
        }
        return $this->sendErrors([], "error");
    }




    //////حذف المنتج من السلة
    ///boshra
    public function destroy($product_id )
    {
        $res = OrderProduct::where('product_id', $product_id)->where('status_id' , OrderStatus::where('status' , 'في السلة')->value('id'))->delete();
        if ($res)
            return $this->sendResponse($res, "success");
        else
            return $this->sendErrors([], "failed");
    }


     //////حذف المنتج المعلقs
    ///boshra
    public function delete_wating_order($order_product_id )
    {
        $res = OrderProduct::where('id', $order_product_id)->delete();
        if ($res)
            return $this->sendResponse($res, "success");
        else
            return $this->sendErrors([], "failed");
    }




    //boshra
    public function bill($order_id)
    {

        $data = DB::table('order_products')->where('order_products.order_id', $order_id)
            ->join('orders', 'orders.id', '=', 'order_products.order_id')
            ->get();


        return $this->sendResponse(BillResource::collection($data), 'success');
    }



    //bayan
    public function mybill($order_id,$store_maneger_id)
    {

        $data = DB::table('order_products')->where('order_products.order_id', $order_id)
            ->join('orders', 'orders.id', '=', 'order_products.order_id')
            ->get();

          $stor_maneger=StoreManager::where('id','=',$store_maneger_id)->value('person_id');
          $email=Persone::where('id','=',$stor_maneger)->value('email');


        return ["email"=>$email,"data"=>mybill_resorce::collection($data)];
    }





    //bayan
    public function order_product($id)
    {
        $product = OrderProduct::where('order_id', '=', $id)->get();
        $g = ordure_product_resource::collection($product);

        return $this->sendResponse($g, 'Store Shop successfully');
    }


    //boshra
    public function all_orderproduct($order_id, $status_id)
    {
        $data = OrderProduct::where('order_id', $order_id)->where('status_id', $status_id)->get();
        return $this->sendResponse(OrderProductResource::collection($data), 'success');
    }

    ///boshra
    public function edit_order_product(StoreOrderProductRequest $request)
    {
        $order_product = OrderProduct::where('order_id' , $request->order_id)->where('product_id' , $request->product_id)->update($request->all()) ;
        if($order_product){
            return $this->sendResponse($order_product , 'success') ;
        }
        return $this->sendErrors([] , 'error') ;

    }
}
