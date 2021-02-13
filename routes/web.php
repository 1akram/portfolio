<?php

use Illuminate\Support\Facades\Route;

 



Route::get('/','App\Http\Controllers\FrontController@profileShow')->name('profile');
Route::get('projcet/{id}/{title}','App\Http\Controllers\ProjectController@showProject')->name('showProject');


Route::get('admin/dashboard','App\Http\Controllers\DashBoardController@show')->name('dashboard');
Route::get('admin/service/add','App\Http\Controllers\ServiceController@addService')->name('addService');
Route::post('admin/service/save','App\Http\Controllers\ServiceController@saveService')->name('saveService');
Route::get('admin/service/edit/{id}','App\Http\Controllers\ServiceController@editService')->name('editService');
Route::post('admin/service/update','App\Http\Controllers\ServiceController@updateService')->name('updateService');

Route::get('admin/project/edit/{id}', function ($id) {dd('dd');})->name('editProject');
 
Route::post('admin/aboutme/update','App\Http\Controllers\InformationController@update')->name('aboutMe.update');

Route::get('', function ( ) {
    dd('lazem tzid nta3 add project edit project  mn ba3d nta3 email ');
}) ;