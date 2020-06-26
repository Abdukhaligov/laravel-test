<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface {
  public function all() {
    return DB::select("CALL get_users");
  }

  public function getById($id) {
    return DB::select("CALL get_user_by_id ($id)")[0];
  }

  public function update($id, $rName, $rCompanyID, $rPositionID){
    return DB::update("CALL update_user (?, ?, ?, ?)", array($id, $rName, $rCompanyID, $rPositionID));
  }
}