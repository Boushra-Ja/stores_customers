<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends BaseController
{

    /////جميع الطلبات
    public function index()
    {
        $orders = Order::all() ;
        if($orders)
        {
            return $this->sendResponse($orders , "sucess") ;
        }

        return  $this->sendErrors([] , 'failed')     ;

    }


    //////////جميع الطلبات المقبولة
    public function acceptence_orders()
    {
        $status_id = OrderStatus::where('id' ,1)->value('id') ;

        $orders = Order::where('status_id' , $status_id)->get() ;

        return $this->sendResponse($orders , 'success');


    }

    public function store(Request $request)
    {


        $validall = $request->validate([
            'product_id' => ['required'],
            'status_id' => ['required'],
            'delivery_time' => ['required'],
            'delivery_price' => ['required'],

        ]);

        $orderProduct = Order::create([
            'status_id' => $request->status_id,
            'product_id' => $request->product_id,
            'customer_id' => auth::id(),
            'delivery_time' => $request->delivery_time,
            'delivery_price' => $request->delivery_price,


        ]);


        $orderProduct->save();

        if ($orderProduct) {
            return $this->sendResponse($orderProduct, 'Store order successfully');
        } else {
            return $this->sendErrors('failed in Store order', ['error' => 'not Store order']);

        }

    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function show(Order $order)
    {
        //
    }


    public function edit(Order $order)
    {
        //
    }


    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }


    public function destroy(Order $order)
    {
        //
    }
}
