<?php

namespace App\Repositories\Interfaces;

interface RoleRepositoryInterface {
  public function all();

  public function clearUserRoles($id);

  public function insertUserRole($id, $roleId);
}