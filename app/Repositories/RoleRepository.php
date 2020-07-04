<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RoleRepositoryInterface;
use DateTime;
use Illuminate\Support\Facades\DB;

class RoleRepository implements RoleRepositoryInterface {
  public function all() {
    return DB::select("CALL get_roles");
  }

  public function clearUserRoles($id) {
    return DB::delete("CALL clear_user_roles('$id')");
  }

  public function insertUserRole($id, $roleId) {
    // TODO: Implement insertUserRole() method.
    return DB::insert("CALL insert_user_role('$id', '$roleId')");
  }
}