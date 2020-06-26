<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface {
  public function all() {
    return User::all();
  }

  public function getById($id) {
    return DB::select("CALL user_get_by_id ($id)")[0];
  }
}