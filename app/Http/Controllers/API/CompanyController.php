<?php

namespace App\Http\Controllers\API;

use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\PositionRepositoryInterface;
use App\Http\Controllers\Controller;

class CompanyController extends Controller {
  private $companyRepository;
  private $positionRepository;

  public function __construct(CompanyRepositoryInterface $companyRepository,
                              PositionRepositoryInterface $positionRepository) {
    $this->companyRepository = $companyRepository;
    $this->positionRepository = $positionRepository;
  }

  public function index() {
    return response()->json($this->companyRepository->all());
  }

  public function show($id) {
    dump($this->companyRepository->getById($id));
    dump($this->positionRepository->getByCompany($id));
    return view('home');
  }
}
