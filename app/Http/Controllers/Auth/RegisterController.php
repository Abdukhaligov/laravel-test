<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Mail\WelcomeMail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller {
  protected $redirectTo = RouteServiceProvider::HOME;

  public function redirectPath() {
    if (method_exists($this, 'redirectTo')) {
      return $this->redirectTo();
    }
    return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
  }

  public function showRegistrationForm() {
    return view('auth.register');
  }

  public function register(UserRequest $request) {
    $user = User::create($request->all());

    Mail::to($user->email)->send(new WelcomeMail($user));

    Auth::guard()->login($user);

    return redirect($this->redirectPath());
  }
}
