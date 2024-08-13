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
                        My Reviews
                    </div>
                    <div class="card-body pb-0">  
                    <div class="d-flex justify-content-end">
                     
                       <form action="{{route('review')}}" method="get">
                        @csrf
                        <div class="d-flex">
                            <input type="text" name="keyword" value="{{Request::get('keyword')}}" id="keyword" class="form-control" placeholder="Search">
                            <button type="submit" class="btn btn-primary ms-2">
                                Search
                            </button>
                            <a href="{{route('review')}}" class="btn btn-dark ms-2">clear</a>
                        </div>
                       </form>
                       
                      </div>          
                        <table class="table  table-striped mt-3">
                            <thead class="table-dark">
                                <tr>
                                <th width="120">Review</th>    
                                <th width="90">Book</th>
                                  
                                    <th width="50">Rating</th>
                                    <th width="90">Created at</th>
                                    <th width="70">Status</th>                                  
                                    <th width="70">Action</th>
                                </tr>
                                <tbody>
@foreach($reviews as $review)

                                    <tr>
                                    <td>{{$review->review}}
                                            <br/>
                                            <span class="text-info">
                                            {{$review->user->name}} 
                                            </span>
                                        </td>
                                        <td>{{$review->book->name}}</td>
                                                                               
                                        <td>{{$review->rating}}.0</td>
                                        <td>{{($review->created_at)->format('d M,Y')}}</td>
                                        <td>
                                        @if($review->status == 1)
                                        <span class="badge badge-success text-dark">Active</span>
                                        @endif
                                        @if($review->status == 0)
                                        <span class="badge badge-danger text-dark">Inactive</span>
                                        @endif
                                        </td>
                                        <td>
                                            <a href="{{route('reviewedit',$review->id)}}" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <a onclick="return confirm('Are you sure?')"  href="{{route('reviewdelete',$review->id)}}" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>


@endforeach
                                                                   
                                </tbody>
                            </thead>
                        </table>   
                        <nav aria-label="Page navigation " >
                           {{$reviews->links()}}
                          </nav>                  
                    </div>
                    
                </div>                
            </div>

        </div>
</div>
@endsection