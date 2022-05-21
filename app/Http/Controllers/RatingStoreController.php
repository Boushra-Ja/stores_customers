<?php

namespace App\Http\Controllers;

use App\Models\RatingStore;
use App\Http\Requests\StoreRatingStoreRequest;
use App\Http\Requests\UpdateRatingStoreRequest;

class RatingStoreController extends Controller
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
     * @param  \App\Http\Requests\StoreRatingStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRatingStoreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RatingStore  $ratingStore
     * @return \Illuminate\Http\Response
     */
    public function show(RatingStore $ratingStore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RatingStore  $ratingStore
     * @return \Illuminate\Http\Response
     */
    public function edit(RatingStore $ratingStore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRatingStoreRequest  $request
     * @param  \App\Models\RatingStore  $ratingStore
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRatingStoreRequest $request, RatingStore $ratingStore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RatingStore  $ratingStore
     * @return \Illuminate\Http\Response
     */
    public function destroy(RatingStore $ratingStore)
    {
        //
    }
}
