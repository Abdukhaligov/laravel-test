@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Dashboard</div>

          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif

            You are logged in!
              <br>
            @foreach($data["users"] as $user)
                <span>
                  {{$user->name}} - {{$user->company ?? " Not working Anywhere"}} - {{$user->position ?? "Without position"}}
                </span>
              <br>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
