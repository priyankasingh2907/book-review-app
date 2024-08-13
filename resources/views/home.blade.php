@extends('account.app')
@section('content')
<div class="container mt-3 pb-5">
        <div class="row justify-content-center d-flex mt-5">
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <h2 class="mb-3">Books</h2>
                    <div class="mt-2">
                        <a href="{{Route('home')}}" class="text-dark">Clear</a>
                    </div>
                </div>
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <form action="{{Route('home')}}" method="get">
                            @csrf
                        <div class="row">
                            <div class="col-lg-11 col-md-11">
                                <input type="text" value="{{Request::get('keyword')}}"
                            class="form-control form-control-lg" name="keyword" placeholder="Search by title">
                            </div>
                            <div class="col-lg-1 col-md-1">
                                <button class="btn btn-primary btn-lg w-100" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>                                                                    
                            </div>                                                                                 
                        </div></form>
                    </div>
                </div>
                <div class="row mt-4">

@foreach($books as $book)
                    <div class="col-md-4 col-lg-3 mb-4">
                        <div class="card border-0 shadow-lg">
                            <a href="{{route('detail',$book->id)}}"><img src="{{asset('uploads/books/'.$book->image)}}" alt="{{$book->name}}" class="card-img-top"></a>
                            <div class="card-body">
                                <h3 class="h4 heading"><a href="#">{{$book->name}}</a></h3>
                                <p>by {{$book->auther}}</p>
                                <div class="star-rating d-inline-flex ml-2" title="{{$book->name}}">
                                    <span class="rating-text theme-font theme-yellow">5.0</span>
                                    <div class="star-rating d-inline-flex mx-2" title="{{$book->name}}">
                                        <div class="back-stars ">
                                            <i class="fa fa-star " aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
        
                                            <div class="front-stars" style="width: 100%">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="theme-font text-muted">({{$book->id}} Reviews)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                 
   @endforeach                 <nav aria-label="Page navigation " >
                       {{$books->links()}}
                      </nav>    
                    
                </div>
            </div>
        </div>
    </div>


@endsection