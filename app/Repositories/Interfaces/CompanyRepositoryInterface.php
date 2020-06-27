<?php

namespace App\Repositories\Interfaces;

interface CompanyRepositoryInterface {
  public function all();

  public function getById($id);

  public function getByPosition($positionID);
}