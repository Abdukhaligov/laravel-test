<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Repositories\Interfaces\PositionRepositoryInterface;
use Illuminate\Http\Request;

class PositionController extends Controller {
  private $positionRepository;

  public function __construct(PositionRepositoryInterface $positionRepository) {
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
