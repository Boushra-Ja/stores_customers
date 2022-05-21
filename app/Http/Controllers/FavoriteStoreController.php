<?php

namespace App\Http\Controllers;

use App\Models\FavoriteStore;
use App\Http\Requests\StoreFavoriteStoreRequest;
use App\Http\Requests\UpdateFavoriteStoreRequest;

class FavoriteStoreController extends Controller
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
     * @param  \App\Http\Requests\StoreFavoriteStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFavoriteStoreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FavoriteStore  $favoriteStore
     * @return \Illuminate\Http\Response
     */
    public function show(FavoriteStore $favoriteStore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FavoriteStore  $favoriteStore
     * @return \Illuminate\Http\Response
     */
    public function edit(FavoriteStore $favoriteStore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFavoriteStoreRequest  $request
     * @param  \App\Models\FavoriteStore  $favoriteStore
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFavoriteStoreRequest $request, FavoriteStore $favoriteStore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FavoriteStore  $favoriteStore
     * @return \Illuminate\Http\Response
     */
    public function destroy(FavoriteStore $favoriteStore)
    {
        //
    }
}
