@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">My Profile</div>
          <div class="card-body">
            Hello {{ $data["user"]->name }}
            <form method="POST" action="{{ route('userUpdate') }}">
              @method("PUT")
              @csrf
              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <div class="col-md-6">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                         name="name" value="{{ old('name') ?? $data["user"]->name }}" required autocomplete="name"
                         autofocus>
                  @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                <div class="col-md-6">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                         name="email" value="{{ old('email') ?? $data["user"]->email }}" disabled autocomplete="email">
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="company"
                       class="col-md-4 col-form-label text-md-right">Company</label>
                <div class="col-md-6">
                  <select id="company" name="company_id"
                          class="form-control cp1 @error('company_id') is-invalid @enderror">
                  <option value="">Select Company</option>
                    @foreach($data["companies"] as $company)
                      <option value="{{ $company->id }}" @if($data["user"]->company_id == $company->id) selected @endif>
                        {{ $company->name }}
                      </option>
                    @endforeach
                  </select>
                  @error('company_id')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="position"
                       class="col-md-4 col-form-label text-md-right">Position</label>
                <div class="col-md-6">
                  <select id="position" name="position_id"
                          class="form-control cp1 @error('position_id') is-invalid @enderror">
                  <option value="">Select Position</option>
                  @foreach($data["positions"] as $position)
                      <option value="{{ $position->id }}"
                              @if($data["user"]->position_id == $position->id) selected @endif>
                        {{ $position->name }}
                      </option>
                    @endforeach
                  </select>
                  @error('position_id')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    Update
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
