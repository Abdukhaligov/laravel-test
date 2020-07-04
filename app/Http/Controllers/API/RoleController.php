<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\RoleRepositoryInterface;

class RoleController extends Controller {
  private $roleRepository;

  public function __construct(RoleRepositoryInterface $roleRepository) {
    $this->roleRepository = $roleRepository;
  }

  public function list() {
    $roles = $this->roleRepository->all();
    return response()->json($roles,200);
  }
}
