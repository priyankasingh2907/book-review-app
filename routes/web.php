<?php

use App\Http\Controllers\Accountcontroller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/',[Accountcontroller::class,'home'])->name('home');
Route::get('/detail/{id}',[Accountcontroller::class,'detail'])->name('detail');
Route::post('/reviewSubmit',[Accountcontroller::class,'reviewSubmit'])->name('reviewSubmit');
       

Route::group(['prefix'=>'account'],function(){
  
    Route::group(['middleware'=>'guest'],function(){
        Route::get('/register',[Accountcontroller::class,'register'])->name('account.register');
        Route::post('/register',[Accountcontroller::class,'registerProcess'])->name('account.registerProcess');
        Route::get('/login',[Accountcontroller::class,'login'])->name('account.login');
        Route::post('/login',[Accountcontroller::class,'authenticate'])->name('account.authenticate');
    });

    Route::group(['middleware'=>'auth'],function(){
        Route::get('/profile',[Accountcontroller::class,'profile'])->name('profile');
        Route::get('/logout',[Accountcontroller::class,'logout'])->name('logout');
        Route::post('/updateProfile',[Accountcontroller::class,'updateProfile'])->name('updateProfile');
        Route::get('/addBook',[Accountcontroller::class,'addBook'])->name('addBook');
        Route::post('/storeBook',[Accountcontroller::class,'storeBook'])->name('storeBook');
        Route::get('/booklist',[Accountcontroller::class,'booklist'])->name('booklist');
        Route::get('/editBook/{id}',[Accountcontroller::class,'editBook'])->name('editBook');
        Route::post('/updateBook/{id}',[Accountcontroller::class,'updateBook'])->name('updateBook');
        Route::get('/delete/{id}',[Accountcontroller::class,'delete'])->name('delete');

        Route::get('/review',[Accountcontroller::class,'review'])->name('review');
        Route::get('/reviewedit/{id}',[Accountcontroller::class,'reviewedit'])->name('reviewedit');
        Route::post('/reviewupdate/{id}',[Accountcontroller::class,'reviewupdate'])->name('reviewupdate');
        Route::get('/reviewdelete/{id}',[Accountcontroller::class,'reviewdelete'])->name('reviewdelete');
      
        Route::get('/changepassword',[Accountcontroller::class,'changepassword'])->name('changepassword');
        Route::post('/updatepassword/{id}',[Accountcontroller::class,'updatepassword'])->name('updatepassword');
       
    });
});