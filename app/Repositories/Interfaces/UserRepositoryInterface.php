<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface {
  public function all();

  public function getById($id);

  public function update($id, $rName, $rCompanyID, $rPositionID);
}