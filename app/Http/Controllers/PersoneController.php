<?php

namespace App\Http\Controllers;

use App\Models\Persone;
use App\Http\Requests\StorePersoneRequest;
use App\Http\Requests\UpdatePersoneRequest;

class PersoneController extends Controller
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
     * @param  \App\Http\Requests\StorePersoneRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePersoneRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Persone  $persone
     * @return \Illuminate\Http\Response
     */
    public function show(Persone $persone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Persone  $persone
     * @return \Illuminate\Http\Response
     */
    public function edit(Persone $persone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePersoneRequest  $request
     * @param  \App\Models\Persone  $persone
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePersoneRequest $request, Persone $persone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Persone  $persone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persone $persone)
    {
        //
    }
}
