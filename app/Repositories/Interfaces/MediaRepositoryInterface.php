<?php

namespace App\Repositories\Interfaces;

interface MediaRepositoryInterface {
  public function lastMediaOrder($model,$id);
  public function insertMedia($modelType, $modelID, $collectionName, $rName, $rFileName, $mimeType, $disk, $size, $orderColumn);
}