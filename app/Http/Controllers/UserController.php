<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\PositionRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
  private $userRepository;
  private $companyRepository;
  private $positionRepository;

  public function __construct(UserRepositoryInterface $userRepository,
                              CompanyRepositoryInterface $companyRepository,
                              PositionRepositoryInterface $positionRepository) {
    $this->userRepository = $userRepository;
    $this->companyRepository = $companyRepository;
    $this->positionRepository = $positionRepository;
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

  public function show($id) {
    dump($this->userRepository->getById($id));
    return view("home");
  }


  public function profile() {
    $data["user"] = Auth::user();
    $data["companies"] = $this->companyRepository->all();
    $data["positions"] = $this->positionRepository->all();

    return view("profile", compact("data"));
  }

  public function update(UserRequest $request) {
    $user = Auth::user() ;
    $user->update($request->all());

    return redirect()->back();
  }

  public function destroy(User $user) {
    //
  }
}
