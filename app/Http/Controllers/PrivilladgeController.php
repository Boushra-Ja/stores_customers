<?php

namespace App\Http\Controllers;

use App\Models\Privilladge;
use Illuminate\Http\Request;
use App\Http\Requests\StorePrivilladgeRequest;
use App\Http\Requests\UpdatePrivilladgeRequest;

class PrivilladgeController extends Controller
{

    public function store(StorePrivilladgeRequest $request)
    {

        $valid = $request->validate([
            'name' => 'required ',

        ]);

        $privilladge = Privilladge::create([
            'name' => $valid['name'],
        ]);


        if ($privilladge) {
            return $this->sendResponse($privilladge, 'Store Shop successfully');
        } else {
            return $this->sendErrors('failed in Store Shop', ['error' => 'not Store Shop']);

        }

    }


    public function update(UpdatePrivilladgeRequest $request, Privilladge $privilladge)
    {
        //
    }


    public function destroy(Privilladge $privilladge)
    {
        //
    }
}
