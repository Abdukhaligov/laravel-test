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

  public function update($id, $name, $companyId, $positionId){
    $now = new DateTime();

    return DB::update("CALL update_user (?, ?, ?, ?, ?)", array($id, $name, $companyId, $positionId, $now));
  }

  public function insert($name, $email, $password, $companyId, $positionId) {
    $now = new DateTime();

    return
        DB::select(
            "CALL insert_user (?, ?, ?, ?, ?, ?, ?)",
            array($name, $email, $password, $companyId, $positionId, $now, $now));
  }
}