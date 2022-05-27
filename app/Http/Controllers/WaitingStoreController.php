<?php

namespace App\Http\Controllers;

use App\Models\WaitingStore;
use App\Http\Requests\StoreWaitingStoreRequest;
use App\Http\Requests\UpdateWaitingStoreRequest;

class WaitingStoreController extends Controller
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
     * @param  \App\Http\Requests\StoreWaitingStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWaitingStoreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WaitingStore  $waitingStore
     * @return \Illuminate\Http\Response
     */
    public function show(WaitingStore $waitingStore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WaitingStore  $waitingStore
     * @return \Illuminate\Http\Response
     */
    public function edit(WaitingStore $waitingStore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWaitingStoreRequest  $request
     * @param  \App\Models\WaitingStore  $waitingStore
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWaitingStoreRequest $request, WaitingStore $waitingStore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WaitingStore  $waitingStore
     * @return \Illuminate\Http\Response
     */
    public function destroy(WaitingStore $waitingStore)
    {
        //
    }
}
