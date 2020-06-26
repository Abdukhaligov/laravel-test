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
    dump($this->companyRepository->all());
    return view('home');
  }
  public function create() {
    //
  }

  public function store(Request $request) {
    //
  }

  public function show($id) {
    dump($this->companyRepository->getById($id));
    dump($this->positionRepository->getByCompany($id));
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
