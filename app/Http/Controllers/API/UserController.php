<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\PositionRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller {
  private $userRepository;

  public function __construct(UserRepositoryInterface $userRepository) {
    $this->userRepository = $userRepository;
  }

  public function login() {
    if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
      $user = Auth::user();
      $token = $user->createToken('MyApp')->accessToken;
      return response()->json(['status' => 'ok', 'token' => $token], 200);
    } else {
      return response()->json(['status' => 'credential error']);
    }
  }

  public function register(UserRequest $request) {
    $request["password"] = bcrypt($request["password"]); //Hashing A Password
    $input = $request->all();

    $user = $this->userRepository->insert(
        $input["name"],
        $input["email"],
        $input["password"],
        $input["company_id"] ?? null,
        $input["position_id"] ?? null
    );

    $user = User::hydrate((array) $user)->first();
    $token = $user->createToken('MyApp')->accessToken;
    Mail::to($user->email)->send(new WelcomeMail($user)); //Sending Welcome Mail to email address

    return response()->json(['status' => 'ok', 'token' => $token], 200);
  }

  public function details() {
    $user = Auth::user();
    return response()->json($user, 201);
  }
}