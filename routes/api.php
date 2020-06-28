<?php

use Illuminate\Support\Facades\Route;

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::post('products', 'API\ProductController@index');
Route::post('companies', 'API\CompanyController@index');
Route::post('positions', 'API\PositionController@index');

Route::group(['middleware' => ['auth:api']], function(){
  Route::post('details', 'API\UserController@details');
  Route::post('products/create', 'API\ProductController@create');
  Route::put('products/delete/{id}', 'API\ProductController@destroy');
  Route::put('products/update', 'API\ProductController@update');
  Route::put('profile/update', 'API\UserController@update');
  Route::get('users/list', 'API\UserController@list');
  Route::get('profile-media', 'API\UserController@profileMedia');
  Route::post('profile-media', 'API\UserController@profileMediaUpload');
});