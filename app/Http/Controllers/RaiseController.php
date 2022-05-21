<?php

namespace App\Http\Controllers;

use App\Models\Raise;
use App\Http\Requests\StoreRaiseRequest;
use App\Http\Requests\UpdateRaiseRequest;

class RaiseController extends Controller
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
     * @param  \App\Http\Requests\StoreRaiseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRaiseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Raise  $raise
     * @return \Illuminate\Http\Response
     */
    public function show(Raise $raise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Raise  $raise
     * @return \Illuminate\Http\Response
     */
    public function edit(Raise $raise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRaiseRequest  $request
     * @param  \App\Models\Raise  $raise
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRaiseRequest $request, Raise $raise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Raise  $raise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Raise $raise)
    {
        //
    }
}
