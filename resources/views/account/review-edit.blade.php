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
                    Add Book
                </div>
                @if(Session::has('success'))

                <p class="alert alert-success">
                    {{ Session::get('success') }}
                </p>
                @endif
                <form action="{{route('reviewupdate' ,$review->id )}}" method="post" >
                    @csrf
                    <div class="card-body">
                     
                    <div class="mb-3">
                            <label for="review" class="form-label">Review</label>
                            <textarea name="review" id="review" class="form-control" cols="5" rows="5" placeholder="Review">
{{$review->review}}
                            </textarea>
                        </div>
                        <input type="hidden" name="review_id" value="{{$review->id}}">
                        @error('review')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                        @enderror

                       

                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <select name="rating" id="rating" class="form-control">
                                <option value="1" {{($review->rating == 1)?'selected' : ''}} >1</option>
                                <option value="2" {{($review->rating == 2)?'selected' : ''}} >2</option>
                                <option value="3" {{($review->rating == 3)?'selected' : ''}} >3</option>
                                <option value="4" {{($review->rating == 4)?'selected' : ''}} >4</option>
                                <option value="5" {{($review->rating == 5)?'selected' : ''}} >5</option>
                            </select>
                        </div>
                        @error('rating')
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
</div>
@endsection