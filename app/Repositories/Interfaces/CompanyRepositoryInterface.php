<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface CompanyRepositoryInterface {
  public function all();

  public function getById($id);

  public function getByPosition($positionID);
}