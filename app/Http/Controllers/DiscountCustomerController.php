<?php

namespace App\Http\Controllers;

use App\Models\DiscountCustomer;
use App\Http\Requests\StoreDiscountCustomerRequest;
use App\Http\Requests\UpdateDiscountCustomerRequest;

class DiscountCustomerController extends Controller
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
     * @param  \App\Http\Requests\StoreDiscountCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiscountCustomerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DiscountCustomer  $discountCustomer
     * @return \Illuminate\Http\Response
     */
    public function show(DiscountCustomer $discountCustomer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DiscountCustomer  $discountCustomer
     * @return \Illuminate\Http\Response
     */
    public function edit(DiscountCustomer $discountCustomer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDiscountCustomerRequest  $request
     * @param  \App\Models\DiscountCustomer  $discountCustomer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiscountCustomerRequest $request, DiscountCustomer $discountCustomer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DiscountCustomer  $discountCustomer
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiscountCustomer $discountCustomer)
    {
        //
    }
}
