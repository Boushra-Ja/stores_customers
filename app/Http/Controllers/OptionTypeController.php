<?php

namespace App\Http\Controllers;

use App\Models\OptionType;
use App\Http\Requests\StoreOptionTypeRequest;
use App\Http\Requests\UpdateOptionTypeRequest;

class OptionTypeController extends Controller
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
     * @param  \App\Http\Requests\StoreOptionTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOptionTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OptionType  $optionType
     * @return \Illuminate\Http\Response
     */
    public function show(OptionType $optionType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OptionType  $optionType
     * @return \Illuminate\Http\Response
     */
    public function edit(OptionType $optionType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOptionTypeRequest  $request
     * @param  \App\Models\OptionType  $optionType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOptionTypeRequest $request, OptionType $optionType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OptionType  $optionType
     * @return \Illuminate\Http\Response
     */
    public function destroy(OptionType $optionType)
    {
        //
    }
}
