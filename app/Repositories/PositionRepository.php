<?php

namespace App\Repositories;

use App\Models\Position;
use App\Repositories\Interfaces\PositionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class PositionRepository implements PositionRepositoryInterface {
  public function all() {
    return Position::all();
  }

  public function getById($id) {
    return DB::select("CALL position_get_by_id ($id)")[0];
  }
}