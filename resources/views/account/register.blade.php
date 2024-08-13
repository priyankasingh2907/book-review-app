@extends('account.app')
@section('content')
        <section class=" p-3 p-md-4 p-xl-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
                        <div class="card border border-light-subtle rounded-4">
                            <div class="card-body p-3 p-md-4 p-xl-5">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-5">
                                            <h4 class="text-center">Register Here</h4>
                                        </div>
                                    </div>
                                </div>
                                @if(Session::has('success'))

                                <p class="alert alert-success">
                                    {{ Session::get('success') }}
                                </p>
                                @endif
                                <form action="{{route('account.registerProcess')}}" method="post">
                                    @csrf
                                    <div class="row gy-3 overflow-hidden">
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" value="{{old('name')}}" class="form-control" name="name" id="name" placeholder="Name" >
                                                <label for="text" class="form-label">Name</label>
                                            </div>
                                            @error('name')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" value="{{old('email')}}"  class="form-control" name="email" id="email" placeholder="name@example.com" >
                                                <label for="text" class="form-label">Email</label>
                                            </div>
                                            @error('email')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="password"  class="form-control" name="password" id="password" value="" placeholder="Password" >
                                                <label for="password" class="form-label">Password</label>
                                            </div>
                                            @error('password')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="" placeholder="Confirm Password" >
                                                <label for="password" class="form-label">Confirm Password</label>
                                            </div>
                                            @error('confirm_password')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn bsb-btn-xl btn-primary py-3" type="submit">Register Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-12">
                                        <hr class="mt-5 mb-4 border-secondary-subtle">
                                        <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-center">
                                            <a href="{{route('account.login')}}" class="link-secondary text-decoration-none">Click here to login</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
   @endsection