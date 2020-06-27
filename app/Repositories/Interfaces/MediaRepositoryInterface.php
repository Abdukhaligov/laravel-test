<?php

namespace App\Repositories\Interfaces;

interface MediaRepositoryInterface {
  public function lastMediaOrder($modelType, $modelId);

  public function insertMedia($modelType, $modelId, $collectionName, $fileName, $fileFullName, $fileMimeType, $disk, $fileSize, $orderColumn);

  public function getMedia($modelType, $modelId, $collectionName);
}