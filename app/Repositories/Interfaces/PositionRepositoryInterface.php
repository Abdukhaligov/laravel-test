<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface PositionRepositoryInterface {
  public function all();

  public function getById($id);
}