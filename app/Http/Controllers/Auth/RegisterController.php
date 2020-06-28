<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Mail\WelcomeMail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\PositionRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller {
  private $companyRepository;
  private $positionRepository;
  private $userRepository;
  protected $redirectTo = RouteServiceProvider::HOME;

  public function __construct(CompanyRepositoryInterface $companyRepository,
                              PositionRepositoryInterface $positionRepository,
                              UserRepositoryInterface $userRepository) {
    $this->companyRepository = $companyRepository;
    $this->positionRepository = $positionRepository;
    $this->userRepository = $userRepository;
  }

  public function redirectPath() {
    if (method_exists($this, 'redirectTo')) {
      return $this->redirectTo();
    }
    return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
  }

  public function showRegistrationForm() {
    $data["companies"] = $this->companyRepository->all();
    $data["positions"] = $this->positionRepository->all();

    return view('auth.register', compact("data"));
  }

}
