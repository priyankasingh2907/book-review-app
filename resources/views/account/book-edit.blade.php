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
                        <img src="{{asset('uploads/'.$user->image)}}" class="img-fluid rounded-circle" alt="{{$user->name}}">
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
                <form action="{{route('updateBook' ,$book->id )}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" value='{{$book->name ,old("title")}}' placeholder="Title" name="title" id="title" />
                        </div>
                        @error('title')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                        @enderror
                        <div class="mb-3">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" class="form-control"  value='{{$book->auther ,old("author")}}' placeholder="Author" name="author" id="author" />
                        </div>
                        @error('author')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                        @enderror
                        <div class="mb-3">
                            <label for="author" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" placeholder="Description" cols="30" rows="5">
                                {{ $book->description ,old("description") }}
                            </textarea>
                        </div>
                        @error('description')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                        @enderror

                        <div class="mb-3">
                            <img src="{{asset('uploads/books/'.$book->image)}}" alt="{{$book->name}}">
                            <label for="Image" class="form-label">Image</label>
                            <input type="file" class="form-control" name="image" id="image" />
                        </div>
                        @error('file')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                        @enderror

                        <div class="mb-3">
                            <label for="author" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ ($book->status == 1) ? 'selected':''}} >Active</option>
                                <option value="0"{{ ($book->status == 0) ? 'selected':''}} >Block</option>
                            </select>
                        </div>


                        <button class="btn btn-primary mt-2" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection