<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Collection;
use App\Http\Requests\StoreCollectionRequest;
use App\Http\Requests\UpdateCollectionRequest;

class CollectionController extends BaseController
{

    public function store(StoreCollectionRequest $request)
    {
        echo "111111111111111111111111";

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'discription' => ['required', 'string'],
            'image' => ['required'],
        ]);
        echo "222222222222222222";
        $input = $request->all();
        echo "333333333333333333";

        $collection  = Collection::create($input);
        echo "4444444444444444444";


        if ($collection) {
            return $this->sendResponse($collection, 'Store Shop successfully');
        } else {
            return $this->sendErrors('failed in Store Shop', ['error' => 'not Store Shop']);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $collection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function edit(Collection $collection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCollectionRequest  $request
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCollectionRequest $request, Collection $collection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $collection)
    {
        //
    }
}
