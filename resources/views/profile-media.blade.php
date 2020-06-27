@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">My Profile</div>
          <div class="card-body">
            Hello {{ $data["user"]->name }}

            <h3 class="jumbotron">Laravel Multiple File Upload</h3>
            <form method="post" action="{{ route("profile-media") }}" enctype="multipart/form-data">
              @csrf

              <div class="input-group control-group increment" >
                <input type="file" name="filename[]" class="form-control">
                <div class="input-group-btn">
                  <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                </div>
              </div>

              <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
