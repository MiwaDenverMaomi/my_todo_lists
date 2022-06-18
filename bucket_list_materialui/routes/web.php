<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BucketListController;

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
    Route::post('/','ContactController@post');
});

// Route::get('/about','AboutController@index');

// Route::group(['prefix'=>'user'],function(){
    // Route::get(`/${profile}`,'UserController@index');
    // Route::patch(`/${profile}/edit-profile`,'UserController@editProfile');
    // Route::patch(`/${profile}/reset-password`,'UserController@resetPassword');
    // Route::post(`/${profile}/reset-password`);
    // Route::patch(`/${profile}/update-favorite`,'UserController@updateFavorite');
    // Route::delete('/delete-favorite','UserController@deleteFavorite');
    // Route::paptch(`/${profile}/update-like`,'UserController@updateLike');
    // Route::delete('/delete-like','UserController@deleteLike');
// });

Route::prefix('/bucket-lists')->group(function(){
    Route::get('/',[BucketListController::class,'index'])->name('bucket-lists.index');
    Route::get('/{user}',[BucketListController::class,'show'])->name('bucket-lists.show');
    Route::post(`/create`,'BucketListController@store');
    Route::post(`/store-like`,'BucketListController@storeLike');
    Route::delete(`/delete-like/{like}`,'BucketListController@deleteLike');
    Route::post(`/store-favorite/`,'BucketListController@storeFavorite');
    Route::delete(`/delete-favorite/{favorite}`,'BucketListController@deleteFavorite');
    Route::patch(`/{bucket_list}`,'BucketListController@update');
    Route::delete(`/{bucket_list}`,'BucketListController@delete');
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
