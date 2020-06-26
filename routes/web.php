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
