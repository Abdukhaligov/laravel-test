<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest {
  public function authorize() {
    return true;
  }

  public function rules() {
    return [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:6', 'confirmed'],
        'company_id' => ['sometimes', 'exists:companies,id'],
        'position_id' => ['sometimes', 'exists:positions,id'],
    ];
  }
}
