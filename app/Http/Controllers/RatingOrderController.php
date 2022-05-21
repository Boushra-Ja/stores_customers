<?php

namespace App\Http\Controllers;

use App\Models\RatingOrder;
use App\Http\Requests\StoreRatingOrderRequest;
use App\Http\Requests\UpdateRatingOrderRequest;

class RatingOrderController extends Controller
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
     * @param  \App\Http\Requests\StoreRatingOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRatingOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RatingOrder  $ratingOrder
     * @return \Illuminate\Http\Response
     */
    public function show(RatingOrder $ratingOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RatingOrder  $ratingOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(RatingOrder $ratingOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRatingOrderRequest  $request
     * @param  \App\Models\RatingOrder  $ratingOrder
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRatingOrderRequest $request, RatingOrder $ratingOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RatingOrder  $ratingOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(RatingOrder $ratingOrder)
    {
        //
    }
}
