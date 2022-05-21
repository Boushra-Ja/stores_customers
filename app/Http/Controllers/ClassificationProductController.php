<?php

namespace App\Http\Controllers;

use App\Models\ClassificationProduct;
use App\Http\Requests\StoreClassificationProductRequest;
use App\Http\Requests\UpdateClassificationProductRequest;

class ClassificationProductController extends Controller
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
     * @param  \App\Http\Requests\StoreClassificationProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClassificationProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassificationProduct  $classificationProduct
     * @return \Illuminate\Http\Response
     */
    public function show(ClassificationProduct $classificationProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassificationProduct  $classificationProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassificationProduct $classificationProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClassificationProductRequest  $request
     * @param  \App\Models\ClassificationProduct  $classificationProduct
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClassificationProductRequest $request, ClassificationProduct $classificationProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassificationProduct  $classificationProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassificationProduct $classificationProduct)
    {
        //
    }
}
