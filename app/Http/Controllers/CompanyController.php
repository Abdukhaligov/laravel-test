<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use Illuminate\Http\Request;

class CompanyController extends Controller {
  private $companyRepository;

  public function __construct(CompanyRepositoryInterface $companyRepository) {
    $this->companyRepository = $companyRepository;
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
