<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\PositionRepositoryInterface;

class PositionController extends Controller {
  private $positionRepository;

  public function __construct(PositionRepositoryInterface $positionRepository) {
    $this->positionRepository = $positionRepository;
  }

  public function index() {
    return response()->json($this->positionRepository->all());
  }
}
