<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface {
  public function all();

  public function insert($name, $category, $price, $userId);

  public function update($id, $name, $category, $price);

  public function delete($id);
}