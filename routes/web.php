<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
  return view('welcome');
});

Route::resource('users','UserController');
Route::resource('companies','CompanyController');
Route::resource('positions','PositionController');

Route::group(['middleware' => ['auth']], function () {
  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('/profile', 'UserController@profile')->name('profile');
  Route::patch('/profile', 'UserController@update')->name('userUpdate');
  Route::get('/profile-media', 'UserController@profileMedia')->name('profileMedia');
  Route::post('/profile-media', 'UserController@profileMediaUpload');
});
