<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Mail\WelcomeMail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\PositionRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller {
  private $companyRepository;
  private $positionRepository;
  protected $redirectTo = RouteServiceProvider::HOME;
  
  public function __construct(CompanyRepositoryInterface $companyRepository,
                              PositionRepositoryInterface $positionRepository) {
    $this->companyRepository = $companyRepository;
    $this->positionRepository = $positionRepository;
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

  public function register(UserRequest $request) {
    $request["password"] = bcrypt($request["password"]); //Hashing A Password

    $user = User::create($request->all()); //Store User in DB

    Mail::to($user->email)->send(new WelcomeMail($user)); //Sending Welcome Mail to email address

    Auth::guard()->login($user); //Login via registered user

    return redirect($this->redirectPath());
  }
}
