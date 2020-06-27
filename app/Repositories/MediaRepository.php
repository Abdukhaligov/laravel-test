<?php

namespace App\Repositories;

use App\Repositories\Interfaces\MediaRepositoryInterface;
use DateTime;
use Illuminate\Support\Facades\DB;

class MediaRepository implements MediaRepositoryInterface {
  public function lastMediaOrder($modelType, $modelId) {
    $query = DB::select(
        "CALL get_media_order_column (?,?)",
        array($modelType, $modelId));

    return $query ? $query[0]->order_column : 0;
  }

  public function getMedia($modelType, $modelId, $collectionName) {
    return DB::select("CALL get_media (?,?,?)", array($modelType, $modelId, $collectionName));
  }


  public function insertMedia($modelType, $modelId, $collectionName, $fileName, $fileFullName, $fileMimeType, $disk, $fileSize, $orderColumn) {
    $now = new DateTime();

    return DB::select(
        "CALL insert_media (?,?,?,?,?,?,?,?,?,?,?)",
        array($modelType, $modelId, $collectionName, $fileName, $fileFullName, $fileMimeType, $disk, $fileSize, $orderColumn, $now, $now))[0]->id;
  }
}