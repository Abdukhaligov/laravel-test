<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
  return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users','UserController');
Route::resource('companies','CompanyController');
Route::resource('positions','PositionController');

Route::group(['middleware' => ['auth']], function () {
  Route::get('/profile', 'UserController@profile')->name('profile');
  Route::put('/profile', 'UserController@update')->name('userUpdate');
});
