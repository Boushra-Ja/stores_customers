<?php

namespace App\Http\Controllers;

use App\Models\StoreManager;
use App\Http\Requests\StoreStoreManagerRequest;
use App\Http\Requests\UpdateStoreManagerRequest;

class StoreManagerController extends Controller
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
     * @param  \App\Http\Requests\StoreStoreManagerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStoreManagerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StoreManager  $storeManager
     * @return \Illuminate\Http\Response
     */
    public function show(StoreManager $storeManager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StoreManager  $storeManager
     * @return \Illuminate\Http\Response
     */
    public function edit(StoreManager $storeManager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStoreManagerRequest  $request
     * @param  \App\Models\StoreManager  $storeManager
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStoreManagerRequest $request, StoreManager $storeManager)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StoreManager  $storeManager
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreManager $storeManager)
    {
        //
    }
}
