<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller {
  private $userRepository;

  public function __construct(UserRepositoryInterface $userRepository) {
    $this->userRepository = $userRepository;
  }

  public function index() {
    dump($this->userRepository->all());
    return view("home");

  }

  public function create() {
    //
  }

  public function store(Request $request) {
    //
  }

  public function show(User $user) {
    dump($this->userRepository->getById($user->id));
    return view("home");
  }

  public function edit(User $user) {
    //
  }

  public function update(Request $request, User $user) {
    //
  }

  public function destroy(User $user) {
    //
  }
}
