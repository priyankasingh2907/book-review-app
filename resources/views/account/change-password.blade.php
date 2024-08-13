
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
                    <div class="card-header  text-white">
                        Change Password
                    </div>
                    @if(Session::has('success'))

<p class="alert alert-success">
    {{ Session::get('success') }}
</p>
@endif
@if(Session::has('error'))

<p class="alert alert-success">
    {{ Session::get('error') }}
</p>
@endif
                    <form action="{{ route('updatepassword' ,Auth::user()->id) }}" method="post">
                        @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="old_password" class="form-label">Old Password</label>
                            <input type="password" class="form-control" value="{{old('password')}}" placeholder="Old Password" name="old_password" id="old_password" />
                        </div>
                        @error('old_password')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                        @enderror
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" placeholder="New Password"  name="password" id="new_password"/>
                        </div>
                        @error('new_password')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                        @enderror
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" placeholder="Confirm Password"  name="password_confirmation" id="confirm_password"/>
                        </div>
                        @error('password_confirmation')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                        @enderror
                        <button class="btn btn-primary mt-2" type="submit">Update</button>                     
                    </div>
                </form>
                </div>                
            </div>
        </div>       
    </div
    @endsection