<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Http\Requests\StoreOrderProductRequest;
use App\Http\Requests\UpdateOrderProductRequest;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderProductController extends Controller
{

    public function index()
    {

    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {


      $request->validate([
            'product_id'=> ['required'],
            'status_id'=> ['required'] ,
            'delivery_time'=>['required'],
            'delivery_price'=> ['required'],

        ]);

        $order = Order::create([
            'status_id'=>$request->status_id,
            'customer_id' => auth::id(),
            'delivery_time'=> $request->delivery_time,
            'delivery_price'=> $request->delivery_price,

        ]);


        $order->save();

        $orderProduct =OrderProduct::create([
        'order_id'=>$order->id,
         'product_id'=>$request->product_id,



        ]);
        $orderProduct->save();

        if ($orderProduct) {
            return $this->sendResponse($orderProduct, 'Store order successfully');
        } else {
            return $this->sendErrors('failed in Store order', ['error' => 'not Store order']);

        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderProduct  $orderProduct
     * @return \Illuminate\Http\Response
     */
    public function show(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderProduct  $orderProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderProductRequest  $request
     * @param  \App\Models\OrderProduct  $orderProduct
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderProductRequest $request, OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderProduct  $orderProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderProduct $orderProduct)
    {
        //
    }
}
