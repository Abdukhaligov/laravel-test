<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest {

  public function authorize() {
    return true;
  }

  public function rules() {
    switch ($this->method()) {
      case 'POST':
      {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'company_id' => ['exists:companies,id'],
            'position_id' => ['exists:positions,id'],
        ];
      }
      case 'PUT':
      case 'PATCH':
      {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [Rule::unique('users')->ignore($this->user()->id)],
            'company_id' => ['sometimes', 'exists:companies,id', 'nullable'],
            'position_id' => ['sometimes', 'exists:positions,id', 'nullable'],
        ];
      }
      default:
        return false;
        break;
    }
  }
}
