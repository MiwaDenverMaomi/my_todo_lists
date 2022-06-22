<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BucketListController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('contact')->group(function(){
    // Route::get('/','ContactController@index');
    Route::post('/',[ContactController::class,'send']);
});

Route::prefix('user')->group(function(){
    Route::get('/{user}',[UserController::class,'index'])->name('user.index');
    Route::patch(`/{user}/edit-profile`,[UserController::class,'editProfile'])->name('user.editProfile');
    Route::patch(`/{user}/reset-password`,[UserController::class,'resetPassword'])->name('user.resetPassword');
    // Route::post(`/reset-password/send-email`,[UserController::class,'sendEmail']);
    Route::patch(`/store-favorite`,[UserController::class,'storeFavorite'])->name('user.storeFavorite');
    Route::delete('/delete-favorite/{favorite}',[UserController::class,'deleteFavorite'])->name('user.deleteFavorite');
    Route::patch(`/store-like`,[UserController::class,'storeLike'])->name('user.storeLike');
    Route::delete('/delete-like/{like}',[UserController::class,'deleteLike'])->name('user.deleteLike');
});

Route::prefix('bucket-lists')->group(function(){
    Route::get('/',[BucketListController::class,'index'])->name('bucket-lists.index');
    Route::get('/{user}',[BucketListController::class,'show'])->name('bucket-lists.show');
    Route::post('/create',[BucketListController::class,'create'])->name('bucket-lists.create');
    Route::post('/store-like',[BucketListController::class,'storeLike'])->name('bucket-lists.store-like');
    Route::delete('/delete-like/{like}',[BucketListController::class,'deleteLike'])->name('bucket-lists.delete-like');
    Route::post('/store-favorite',[BucketListController::class,'storeFavorite'])->name('bucket-lists.store-favorite');
    Route::delete('/delete-favorite/{favorite}',[BucketListController::class,'deleteFavorite'])->name('bucket-lists.delete-favorite');
    Route::patch('/bucket-list-item/{bucket_list}',[BucketListController::class,'updateBucketListItem'])->name('bucket-lists.bucket-list-item');
    Route::patch('/is-done/{bucket_list}',[BucketListController::class,'updateIsDone'])->name('bucket-lists.is-done');
    Route::delete('/{bucket_list}',[BucketListController::class,'delete'])->name('bucket-lists.delete');
});

// Route::group(['prefix'=>'login'],function(){
//     Route::get('/','LoginController@index');
//     Route::post('/','LoginController@store');
// });

// Route::post('/logout','LogoutController@logout');

Route::get('/', function () {
    return view('index');
})->where(['all'=>'.*']);

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
