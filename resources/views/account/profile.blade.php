@extends('account.app')
@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-lg">
                <div class="card-header  text-white">
                    Welcome, {{$user->name}}
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <img src="{{asset('uploads/'.$user->image)}}" class="img-fluid rounded-circle" alt="Luna John">
                    </div>
                    <div class="h5 text-center">
                        <strong>{{$user->name}} </strong>
                        <p class="h6 mt-2 text-muted">5 Reviews</p>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-lg mt-3">
                <div class="card-header  text-white">
                    Navigation
                </div>
              @include('account.sidebar')
            </div>
        </div>
        <div class="col-md-9">
            <div class="card border-0 shadow">
                <div class="card-header  text-white">updateProfile
                    Profile
                </div>
                @if(Session::has('success'))

                <p class="alert alert-success">
                    {{ Session::get('success') }}
                </p>
                @endif
                <form action="{{route('updateProfile')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" value="{{$user->name}} " class="form-control" placeholder="Name" name="name" id="" />
                        </div> @error('name')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                        @enderror
                        <div class="mb-3">
                            <label for="name" class="form-label">Email</label>
                            <input type="text" value="{{$user->email}} " class="form-control" placeholder="Email" name="email" id="email" />
                        </div> @error('email')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                        @enderror
                        <div class="mb-3">
                            <label for="name" class="form-label">Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                            <img src="{{asset('uploads/'.$user->image)}}" class="img-fluid mt-4" alt="Luna John">
                        </div>
                        <button class="btn btn-primary mt-2 " type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection