<?php

namespace App\Repositories\Interfaces;

interface PositionRepositoryInterface {
  public function all();

  public function getById($id);

  public function getByCompany($companyId);
}