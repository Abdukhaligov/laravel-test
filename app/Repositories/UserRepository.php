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
}