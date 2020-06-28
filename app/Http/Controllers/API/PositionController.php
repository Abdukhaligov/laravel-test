<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\PositionRepositoryInterface;

class PositionController extends Controller {
  private $companyRepository;
  private $positionRepository;

  public function __construct(CompanyRepositoryInterface $companyRepository,
                              PositionRepositoryInterface $positionRepository) {
    $this->companyRepository = $companyRepository;
    $this->positionRepository = $positionRepository;
  }

  public function index() {
    return response()->json($this->positionRepository->all());
  }

  public function show($id) {
    dump($this->positionRepository->getById($id));
    dump($this->companyRepository->getByPosition($id));
    return view('home');
  }
}
