<?php

namespace App\Repositories;

use App\Repositories\Interfaces\MediaRepositoryInterface;
use App\Repositories\Interfaces\PositionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class MediaRepository implements MediaRepositoryInterface {
  public function nextMediaOrder($model, $id) {
    $query = DB::select(
        "CALL get_media_order_column (?,?)",
        array($model,$id));

    return $query ? $query[0]->order_column + 1 : 1;
  }

}