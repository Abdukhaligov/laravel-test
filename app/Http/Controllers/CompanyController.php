<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\PositionRepositoryInterface;
use Illuminate\Http\Request;

class CompanyController extends Controller {
  private $companyRepository;
  private $positionRepository;

  public function __construct(CompanyRepositoryInterface $companyRepository,
                              PositionRepositoryInterface $positionRepository) {
    $this->companyRepository = $companyRepository;
    $this->positionRepository = $positionRepository;
  }

  public function index() {
    return $this->companyRepository->all();
  }
  public function create() {
    //
  }

  public function store(Request $request) {
    //
  }

  public function show(Company $company) {
    dump($this->companyRepository->getById($company->id));
    dump($this->positionRepository->getByCompany($company->id));
    return view('home');
  }

  public function edit(Company $company) {
    //
  }

  public function update(Request $request, Company $company) {
    //
  }

  public function destroy(Company $company) {
    //
  }
}
