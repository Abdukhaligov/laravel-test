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
    return $this->userRepository->all();
  }

  public function create() {
    //
  }

  public function store(Request $request) {
    //
  }

  public function show(User $user) {
    return $this->userRepository->getById($user->id);
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
