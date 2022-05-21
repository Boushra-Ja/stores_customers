<?php

namespace App\Http\Controllers;

use App\Models\OrderStatuse;
use App\Http\Requests\StoreOrderStatuseRequest;
use App\Http\Requests\UpdateOrderStatuseRequest;

class OrderStatuseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderStatuseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderStatuseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderStatuse  $orderStatuse
     * @return \Illuminate\Http\Response
     */
    public function show(OrderStatuse $orderStatuse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderStatuse  $orderStatuse
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderStatuse $orderStatuse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderStatuseRequest  $request
     * @param  \App\Models\OrderStatuse  $orderStatuse
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderStatuseRequest $request, OrderStatuse $orderStatuse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderStatuse  $orderStatuse
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderStatuse $orderStatuse)
    {
        //
    }
}
