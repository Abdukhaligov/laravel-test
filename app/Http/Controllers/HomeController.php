<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\UserRepositoryInterface;

class HomeController extends Controller {
  private $userRepository;

  public function __construct(UserRepositoryInterface $userRepository) {
    $this->userRepository = $userRepository;
  }

  public function index() {
    $data ["users"] = $this->userRepository->all();

    return view('home', compact("data"));
  }
}
