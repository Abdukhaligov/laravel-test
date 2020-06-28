<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ProductRequest extends FormRequest {
  public function authorize() {
    return true;
  }

  public function rules() {
    return [
        'name' => ['required'],
        'category' => ['required'],
        'price' => ['required', 'int']
    ];
  }

  public function messages() {
    return [
      //
    ];
  }

  protected function failedValidation(Validator $validator) {
    $errors = (new ValidationException($validator))->errors();
    throw new HttpResponseException(response()->json(['errors' => $errors
    ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
  }
}
