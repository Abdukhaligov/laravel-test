<?php

namespace App\Repositories;

use App\Models\Company;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CompanyRepository implements CompanyRepositoryInterface {
  public function all() {
    return Company::all();
  }

  public function getById($id) {
    return DB::select("CALL company_get_by_id ($id)")[0];
  }

  public function getByPosition($positionID) {
    return DB::select("CALL companies_get_by_position ($positionID)");
  }
}