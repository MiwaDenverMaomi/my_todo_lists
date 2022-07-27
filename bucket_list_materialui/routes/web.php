<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BucketListController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GeneralController;

//Top page
Route::get('/',[BucketListController::class,'index'])->name('bucket-lists.index');
Route::get('/search',[BucketListController::class,'searchKeyword'])->name('bucket-lists.searchKeyword');
//Register,Login,Logout,cancel
Route::get('/register',[RegisterController::class,'getRegister'])->name('register.getRegister');
Route::post('/register',[RegisterController::class,'postRegister'])->name('register.postRegister');
Route::get('/login',[LoginController::class,'getLogin'])->name('login.getLogin');
Route::post('/login',[LoginController::class,'postLogin'])->name('login.postLogin');
Route::prefix('contact')->group(function(){
    Route::get('/','ContactController@index')->name('contact.getContact');
    Route::post('/',[ContactController::class,'send'])->name('contact.postContact');
});

Route::group(['middleware'=>'auth'],function(){
  Route::get('/logout',[LoginController::class,'logout'])->name('login.logout');
  Route::get('/cancel',[RegisterController::class,'getCancel'])->name('register.getCancel');
  Route::delete('/cancel/{user}',[RegisterController::class,'cancel'])->name('register.cancel');
});

//General menu
Route::prefix('general')->group(function(){
    Route::get('/about',[GeneralController::class,'getAbout'])->name('general.getAbout');
    Route::get('/help',[GeneralController::class,'getHelp'])->name('general.getHelp');
});

//User profile, like, favorite
Route::prefix('user')->group(function(){
    Route::get('/{user}',[UserController::class,'index'])->name('user.index');

    Route::group(['middleware'=>'auth'],function(){
      Route::patch('/{user}/edit-profile',[UserController::class,'editProfile'])->name('user.editProfile');
      Route::get('/{user}/show-profile',[UserController::class,'showProfile'])->name('user.showProfile');
      Route::get('/{user}/edit-profile-mode/{edit_mode}',[UserController::class,'editProfileMode'])->name('user.editProfileMode');
      Route::patch(`/{user}/reset-password`,[UserController::class,'resetPassword'])->name('user.resetPassword');
      // Route::post(`/reset-password/send-email`,[UserController::class,'sendEmail']);
      Route::patch(`/store-favorite`,[UserController::class,'storeFavorite'])->name('user.storeFavorite');
      Route::delete('/delete-favorite/{favorite}',[UserController::class,'deleteFavorite'])->name('user.deleteFavorite');
      Route::patch(`/store-like`,[UserController::class,'storeLike'])->name('user.storeLike');
      Route::delete('/delete-like/{like}',[UserController::class,'deleteLike'])->name('user.deleteLike');
});
});

//My page
Route::group(['middleware'=>'auth'],function(){
  Route::prefix('todo-list')->group(function(){
    Route::get('/show/{user}',[BucketListController::class,'show'])->name('bucket-lists.show');
    Route::post('/create',[BucketListController::class,'create'])->name('bucket-lists.create');
    Route::patch('/update-title/{bucket_list}',[BucketListController::class,'updateTitle'])->name('bucket-lists.update-title');
    Route::patch('/is-done/{bucket_list}',[BucketListController::class,'updateIsDone'])->name('bucket-lists.update-is-done');
    Route::delete('/delete/{bucket_list}',[BucketListController::class,'delete'])->name('bucket-lists.delete');

    //Like, favorite
    Route::post('/store-like',[BucketListController::class,'storeLike'])->name('bucket-lists.store-like');
    Route::delete('/delete-like/{like}',[BucketListController::class,'deleteLike'])->name('bucket-lists.delete-like');
    Route::post('/store-favorite',[BucketListController::class,'storeFavorite'])->name('bucket-lists.store-favorite');
    Route::delete('/delete-favorite/{favorite}',[BucketListController::class,'deleteFavorite'])->name('bucket-lists.delete-favorite');
  });
});
