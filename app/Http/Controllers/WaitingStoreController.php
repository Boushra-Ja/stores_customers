<?php

namespace App\Http\Controllers;

use App\Models\WaitingStore;
use App\Http\Requests\StoreWaitingStoreRequest;
use App\Http\Requests\UpdateWaitingStoreRequest;

class WaitingStoreController extends Controller
{
  public static function store(int $store){

      $waitingStore =WaitingStore::create([
          'store_id' => $store
      ]);
  }
}
