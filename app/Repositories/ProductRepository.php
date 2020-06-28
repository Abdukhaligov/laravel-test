<?php

namespace App\Repositories;

use App\Models\Company;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use DateTime;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface {
  public function all() {
    return DB::select("CALL get_products");
  }

  public function insert($name, $category, $price, $userId) {
    $now = new DateTime();

    return DB::insert(
        "CALL insert_product (?,?,?,?,?,?)",
        array($name, $category, $price, $userId, $now, $now));
  }

  public function update($id, $name, $category, $price){
    $now = new DateTime();

    return DB::update("CALL update_product (?, ?, ?, ?, ?)", array($id, $name, $category, $price, $now));
  }

  public function delete($id) {
    return DB::delete("CALL delete_product ($id)");
  }
}