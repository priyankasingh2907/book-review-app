


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
                        Books
                    </div>
                    <div class="card-body pb-0">            
                      <div class="d-flex justify-content-between">
                      <a href="{{route('addBook')}}" class="btn btn-primary">Add Book</a>
                     
                       <form action="{{route('booklist')}}" method="get">
                        @csrf
                        <div class="d-flex">
                            <input type="text" name="keyword" value="{{Request::get('keyword')}}" id="keyword" class="form-control" placeholder="Search">
                            <button type="submit" class="btn btn-primary ms-2">
                                Search
                            </button>
                            <a href="{{route('booklist')}}" class="btn btn-dark ms-2">clear</a>
                        </div>
                       </form>
                       
                      </div>
                        <table class="table  table-striped mt-3">


                            <thead class="table-dark">
                                <tr>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Rating</th>
                                    <th>Status</th>
                                    <th width="150">Action</th>
                                </tr>
                                <tbody>
                                    @foreach($books as $book)
                                    <tr>
                                        <td>{{$book->name}}</td>
                                        <td>{{$book->auther}}</td>
                                        <td>3.0 (3 Reviews)</td>
                                        <td>
                                            {{
                                                 $book->status == 1? 'Available' : 'Not Available'
 
                                            }}
                                        </td>
                                        <td>
                                            <a href="{{route('detail',$book->id)}}" ><span style="color: yellow;" class="material-symbols-outlined">
info
</span></a>
                                            <a href="{{route('editBook',$book->id)}}" ><span style="color: green;" class="material-symbols-outlined">
edit
</span>
                                            </a>
                                            <a   onclick="return confirm('Are you sure?')"  href="{{route('delete',$book->id)}}" ><span style="color: red;" class="material-symbols-outlined">
delete
</span></a>
                                        </td>
                                    </tr>
                                 @endforeach
                                </tbody>
                            </thead>
                        </table>   
                        <nav aria-label="Page navigation " >
                           {{$books->links()}}
                          </nav>                  
                    </div>
                    
                </div>                
            </div>
        </div>       
    </div>


    @endsection