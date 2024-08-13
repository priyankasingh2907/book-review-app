<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use PDO;

class Accountcontroller extends Controller
{
    public function register(){

        return view('account.register');

    }
    public function registerProcess(Request $request){

        $validator = Validator::make($request->all(),[

            'name'=> 'required|min:3',
            'email'=> 'required|email',
            'password'=> 'required|confirmed|min:5',
          
 ]);

 if($validator->fails()){
  return redirect()->route('account.register')->withInput()->withErrors($validator);  
 }

 $user = new User;
 $user->name = $request->name; 
 $user->email = $request->email;
 $user->password = Hash::make($request->password);
 $user->save();

 return redirect()->route('account.register')->with('success','Successfully Registered');
    }
    public function login() {
        return view('account.login');
        
    }
    public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=> 'required|email',
            'password'=> 'required|min:5',
       
 ]);   
 if($validator->fails()){
    return redirect()->route('account.login')->withInput()->withErrors($validator);
 }

 if(Auth::attempt(['email'=>$request->email , 'password'=>$request->password],$request->get('remember'))){
    
    return redirect()->route('profile')->with('success','');
 }else{
    return redirect()->route('account.login')->withInput()->withErrors($validator)->with('error','Either Email or Password is incorrect..');

 }

    }
    public function profile(){

        $user = User::find(Auth::user()->id);

        return view('account.profile',['user'=>$user]);
    }
    public function logout(){
     Auth::logout();
     return redirect()->route('account.login');
    }
    public function updateProfile(Request $request){
        $validator = Validator::make($request->all(),[

            'name'=> 'required|min:3',
            'email'=> 'required|email',
           'image'=>'required'
 ]);

 if($validator->fails()){
  return redirect()->route('profile')->withInput()->withErrors($validator);  
 }
 $img = $request->image;
$ext = $img->getClientOriginalExtension();
$imageName = time().'.'.$ext;
$img->move( public_path().'/uploads/', $imageName);



 $user = User::find(Auth::user()->id);
 $user->name = $request->name; 
 $user->email = $request->email;
 $user->image = $imageName;
 $user->save();

 return redirect()->route('profile')->with('success','Successfully Registered');
 

    }

    public function addBook()
    {
        $user = User::find(Auth::user()->id);

        return view('account.add-book',['user'=>$user]);
        

    }
    public function storeBook(Request $request){
        
        $validator = Validator::make($request->all(),[

            'title'=> 'required|min:3',
            'author'=> 'required',
           'image'=>'required',
            'description'=>'required',
            'status'=>'required',
 ]);

 if($validator->fails()){
  return redirect()->route('addBook')->withInput()->withErrors($validator);  
 }

 $img = $request->image;
 $ext = $img->getClientOriginalExtension();
 $imageName = time().'.'.$ext;
 $img->move( public_path().'/uploads/books/', $imageName);
 
 $book = new book;
 $book->name = $request->title; 
 $book->auther = $request->author;
 $book->image =$imageName ; 
 $book->description = $request->description;
 $book->status = $request->status; 

 $book->save();

 return redirect()->route('addBook')->with('success','Successfully Added');
    }
    public function booklist(Request $request){

        $books = book::latest('id');
        if(!empty($request->get('keyword'))){
            $books = book::where('name','LIKE','%'.$request->get('keyword').'%')->latest('id');;
        }


        $books=  $books->paginate(5);
        $user = User::find(Auth::user()->id);
        return view('account.book-listing' ,['books'=>$books ,'user'=>$user]);
    }
    public function editBook(Request $request , $id){
        $book = book::find($id);
        $user = User::find(Auth::user()->id);
        return view('account.book-edit' ,['book'=>$book ,'user'=>$user]);
    }
    public function updateBook(Request $request , $id){
        $book = book::find($id);   
        $validator = Validator::make($request->all(),[

            'title'=> 'required|min:3',
            'author'=> 'required',
           'image'=>'required',
            'description'=>'required',
            'status'=>'required',
 ]);

 if($validator->fails()){
  return redirect()->route('editBook' ,$book->id )->withInput()->withErrors($validator);  
 }

 $img = $request->image;
 $ext = $img->getClientOriginalExtension();
 $imageName = time().'.'.$ext;
 $img->move( public_path().'/uploads/books/', $imageName);
 
 $book = book::find($id);
 $book->name = $request->title; 
 $book->auther = $request->author;
 $book->image =$imageName ; 
 $book->description = $request->description;
 $book->status = $request->status; 

 $book->save();

 return redirect()->route('booklist')->with('success','Successfully Updated');
    }
    public function delete(Request $request , $id){


  $book= book::find($id);
  $book->delete();
  return redirect()->route('booklist')->with('success','Successfully deleted');
    }
    

    public function detail(Request $request , $id){

        $book = book::with('reviews','reviews.user')->find($id);

        // dd($book);
        // $user = User::find(Auth::user()->id);
        $books = book::where('id','!=',$id)->take(3)->inRandomOrder()->get();
        return view('account.detail-book' ,['book'=>$book ,'books'=>$books]);
    
    }
    
    public function changepassword(){

        $user = User::find(Auth::user()->id);
        return view('account.change-password' ,['user'=>$user]);
    
    }
    
    public function updatepassword(Request $request,$id){

        // $book = book::find($id);
        $user = User::find($id);
       
        $validator = Validator::make($request->all(),[

            'old_password'=> 'required|min:3',
            'password'=> 'required|confirmed|min:3',
    
 ]);

 if($validator->fails()){
  return redirect()->route('changepassword')->withInput()->withErrors($validator);  
 }

 if(!Hash::check($request->old_password, $user->password)){
    return redirect()->route('changepassword')->withInput()->with('error','Old Password is incorrect..');
 }

 $user->password= Hash::make($request->new_password);
 $user->save();
 return redirect()->route('changepassword')->with('success','you have changed your password');
  
    }

    public function home(Request $request){
        
        $books = book::latest('id');
        if(!empty($request->get('keyword'))){
            $books = book::where('name','LIKE','%'.$request->get('keyword').'%')->latest('id');;
        }


        $books=  $books->paginate(10);
        // $user = User::find(Auth::user()->id);
        return view('home' ,['books'=>$books ]);

    }

    public function reviewSubmit(Request $request)  {
        
    // dd($request);
     $validator= validator::make($request->all(),[
            'review'=>'required',
            'rating'=>'required',
        ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        
        }

        $book_id = $request->book_id;
        $user_id = Auth::user()->id;
       

        $review = new review;
        $review->book_id = $book_id;
        $review->user_id = $user_id;
        $review->rating = $request->rating;
        $review->review = $request->review;
        $review->save();

        return redirect()->route('detail', $book_id)->with('success', 'Review submitted successfully');
   
     }


   
     public function review(request $request){
     
        $reviews= review::with('book')->latest();
// dd($reviews);
        if(!empty($request->get('keyword'))){
            $reviews = $reviews->where('review','LIKE','%'.$request->get('keyword').'%')->latest('id');;
        }


        $reviews=  $reviews->paginate(5);
        $user = User::find(Auth::user()->id);
        return view('account.review' ,['reviews'=>$reviews ,'user'=>$user]);
       
        
     }
     public function reviewdelete(Request $request , $id){
        $review= review::find($id);
        $review->delete();
        return redirect()->route('review')->with('success','Successfully deleted');
    }
    public function reviewedit(Request $request , $id){
        $user = User::find(Auth::user()->id);
        $review = review::with('book')->find($id);
        // dd($review);
        return view('account.review-edit' ,['user'=>$user,'review'=>$review]);
    }
    public function reviewupdate(Request $request , $id){
        $review = review::with('book')->find($id);   
        $validator = Validator::make($request->all(),[

           'review'=> 'required',
            'rating'=>'required',]);
            if($validator->fails()){
                return redirect()->route('reviewedit' ,$review->id)->withInput()->withErrors($validator);
            }
            $review->rating = $request->rating;
            $review->review = $request->review;
            $review->save();
            return redirect()->route('review')->with('success','Successfully Updated');

    }
}
