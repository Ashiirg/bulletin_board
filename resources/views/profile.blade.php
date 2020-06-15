@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    @if ($message = Session::get('success-message'))
      <div class="alert alert-success">
        {{ $message }}
      </div>
    @endif
    @if ($message = Session::get('fail-message'))
      <div class="alert alert-danger">
        {{ $message }}
      </div>
    @endif
  </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-4">
          
          <div class="profile__wrap">

            <h3>Edit profile</h3>
            <form action="{{ url('profile/edit') }}" method="POST">
              @csrf

              <div class="form-group">
                <label for="first_name" class="col-form-label">First name</label>
                <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ Auth::user()->first_name }}" required>

                @error('first_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="email" class="col-form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required>

                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="password" class="col-form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="" required>

                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Edit profile</button>
              </div>

            </form>

          </div>

        </div>
        <div class="col-md-6 offset-md-2">
          
          <div class="post-create__wrap">

            <h3>Create post</h3>
            <form action="{{ url('profile/post/create') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="form-group">
                <label for="title" class="col-form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required>

                @error('title')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="description" class="col-form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3" required>{{ old('description') }}</textarea>

                @error('description')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="file" class="col-form-label">Image</label>
                <input type="file" class="form-control-file @error('file') is-invalid @enderror" name="file">

                @error('file')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Create post</button>
              </div>

            </form>

          </div>

        </div>
    </div>
</div>
@endsection
