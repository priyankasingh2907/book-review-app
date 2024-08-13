
<div class="card-body sidebar">
<ul class="nav flex-column">
@if(Auth::user()->role == 'admin')             

                        <li class="nav-item">
                            <a href="{{route('booklist')}}">Books</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('review')}}">Reviews</a>
                        </li>

@endif
                        <li class="nav-item">
                            <a href="{{route('profile')}}">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="">My Reviews</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('changepassword',Auth::user()->id)}}">Change Password</a>
                        </li>
                        <li class="nav-item">
                            <a  onclick="return confirm('Are you sure?')" href="{{route('logout')}}">Logout</a>
                        </li>
                    </ul>
                </div>