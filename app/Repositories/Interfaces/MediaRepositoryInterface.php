<?php

namespace App\Repositories\Interfaces;

interface MediaRepositoryInterface {
  public function nextMediaOrder($model,$id);
}