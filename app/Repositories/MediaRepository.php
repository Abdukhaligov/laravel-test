<?php

namespace App\Repositories;

use App\Repositories\Interfaces\MediaRepositoryInterface;
use App\Repositories\Interfaces\PositionRepositoryInterface;
use DateTime;
use Illuminate\Support\Facades\DB;

class MediaRepository implements MediaRepositoryInterface {
  public function lastMediaOrder($model, $id) {
    $query = DB::select(
        "CALL get_media_order_column (?,?)",
        array($model, $id));

    return $query ? $query[0]->order_column : 0;
  }

  public function getMedia($model, $id, $collectionName) {
    return DB::select("CALL get_media (?,?,?)", array($model, $id, $collectionName));
  }


  public function insertMedia($modelType, $modelID, $collectionName, $rName, $rFileName, $mimeType, $disk, $size, $orderColumn) {
    $now = new DateTime();

    return DB::select(
        "CALL insert_media (?,?,?,?,?,?,?,?,?,?,?)",
        array($modelType, $modelID, $collectionName, $rName, $rFileName, $mimeType, $disk, $size, $orderColumn, $now, $now))[0]->id;
  }
}