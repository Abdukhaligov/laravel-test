@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">My Profile</div>
          <div class="card-body">
            Hello {{ $data["user"]->name }}


            <form action="{{ route("profileMedia") }}" method="post" enctype="multipart/form-data">
              @csrf

              <input type="file" class="form-control" name="uploads[]" multiple />
              <br />
              <input type="submit" class="btn btn-primary" value="Upload" />
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
