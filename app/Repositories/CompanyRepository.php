<?php

namespace App\Repositories;

use App\Models\Company;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CompanyRepository implements CompanyRepositoryInterface {
  public function all() {
    return DB::select("CALL get_companies");
  }

  public function getById($id) {
    return DB::select("CALL get_company_by_id ($id)")[0];
  }

  public function getByPosition($positionId) {
    return DB::select("CALL get_companies_by_position ($positionId)");
  }
}