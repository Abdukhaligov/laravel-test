<?php

namespace App\Http\Controllers\API;

use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\PositionRepositoryInterface;
use App\Http\Controllers\Controller;

class CompanyController extends Controller {
  private $companyRepository;

  public function __construct(CompanyRepositoryInterface $companyRepository) {
    $this->companyRepository = $companyRepository;
  }

  public function index() {
    return response()->json($this->companyRepository->all());
  }
}
