<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use DateTime;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface {
  public function all() {
    return DB::select("CALL get_users");
  }

  public function getById($id) {
    return DB::select("CALL get_user_by_id ($id)")[0];
  }

  public function update($id, $rName, $rCompanyID, $rPositionID){
    $now = new DateTime();

    return DB::update("CALL update_user (?, ?, ?, ?, ?)", array($id, $rName, $rCompanyID, $rPositionID, $now));
  }

  public function insert($rName, $rEmail, $rPassword, $rCompanyID, $rPositionID) {
    $now = new DateTime();

    return
        DB::select(
            "CALL insert_user (?, ?, ?, ?, ?, ?, ?)",
            array($rName, $rEmail, $rPassword, $rCompanyID, $rPositionID, $now, $now));
  }
}