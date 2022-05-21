<?php

namespace App\Http\Controllers;

use App\Models\DiscountProduct;
use App\Http\Requests\StoreDiscountProductRequest;
use App\Http\Requests\UpdateDiscountProductRequest;

class DiscountProductController extends Controller
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
     * @param  \App\Http\Requests\StoreDiscountProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiscountProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DiscountProduct  $discountProduct
     * @return \Illuminate\Http\Response
     */
    public function show(DiscountProduct $discountProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DiscountProduct  $discountProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(DiscountProduct $discountProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDiscountProductRequest  $request
     * @param  \App\Models\DiscountProduct  $discountProduct
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiscountProductRequest $request, DiscountProduct $discountProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DiscountProduct  $discountProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiscountProduct $discountProduct)
    {
        //
    }
}
