<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\PositionRepositoryInterface;
use Illuminate\Http\Request;

class PositionController extends Controller {
  private $companyRepository;
  private $positionRepository;

  public function __construct(CompanyRepositoryInterface $companyRepository,
                              PositionRepositoryInterface $positionRepository) {
    $this->companyRepository = $companyRepository;
    $this->positionRepository = $positionRepository;
  }

  public function index() {
    return $this->positionRepository->all();
  }
  public function create() {
    //
  }

  public function store(Request $request) {
    //
  }

  public function show(Position $position) {
    dump($this->positionRepository->getById($position->id));
    dump($this->companyRepository->getByPosition($position->id));
    return view('home');
  }

  public function edit(Position $position) {
    //
  }

  public function update(Request $request, Position $position) {
    //
  }

  public function destroy(Position $position) {
    //
  }
}
