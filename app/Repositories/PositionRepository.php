<?php

namespace App\Repositories;

use App\Repositories\Interfaces\PositionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class PositionRepository implements PositionRepositoryInterface {
  public function all() {
    return DB::select("CALL get_positions");
  }

  public function getById($id) {
    return DB::select("CALL get_position_by_id ($id)")[0];
  }

  public function getByCompany($companyId) {
    return DB::select("CALL get_positions_by_company ($companyId)");
  }
}