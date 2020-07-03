<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface {
  public function all();

  public function getById($id);

  public function insert($name, $email, $password, $companyId, $positionId);

  public function update($id, $name, $companyId, $positionId);

  public function delete($id);
}