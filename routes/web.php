<?php

use Illuminate\Support\Facades\Route;

 

//public accesse
Route::get('/','App\Http\Controllers\FrontController@profileShow')->name('profile');

// accesse for non logged users ->middleware('auth')
Route::middleware(['guest'])->group(function () {
Route::get('admin','App\Http\Controllers\AuthController@login')->name('login');
Route::post('login','App\Http\Controllers\AuthController@loginCheck')->name('loginCheck');

});


// accesse fro logged users

Route::middleware(['auth'])->group(function () {
    Route::get('logout','App\Http\Controllers\AuthController@logout')->name('logout');
    Route::get('admin/dashboard','App\Http\Controllers\DashBoardController@show')->name('dashboard'); 
    Route::get('admin/service/add','App\Http\Controllers\ServiceController@addService')->name('addService');
    Route::post('admin/service/save','App\Http\Controllers\ServiceController@saveService')->name('saveService');
    Route::get('admin/service/edit/{id}','App\Http\Controllers\ServiceController@editService')->name('editService');
    Route::post('admin/service/update','App\Http\Controllers\ServiceController@updateService')->name('updateService');
    Route::post('admin/service/delete', 'App\Http\Controllers\ServiceController@deleteService')->name('deleteService');
    Route::get('projcet/{id}/{title}','App\Http\Controllers\ProjectController@showProject')->name('showProject');
    Route::get('admin/project/add', 'App\Http\Controllers\ProjectController@addProject')->name('addProject');
    Route::post('admin/project/save', 'App\Http\Controllers\ProjectController@saveProject')->name('saveProject'); 
    Route::get('admin/project/edit/{id}','App\Http\Controllers\ProjectController@editProject')->name('editProject'); 
    Route::post('admin/project/update', 'App\Http\Controllers\ProjectController@updateProject')->name('updateProject'); 
    Route::post('admin/project/{projectId}/deleteImage', 'App\Http\Controllers\ProjectController@deleteProjectImage')->name('deleteProjectImage');
    Route::post('admin/project/delete', 'App\Http\Controllers\ProjectController@deleteProject')->name('deleteProject');
    Route::post('admin/setting/update', 'App\Http\Controllers\SettingController@updateSetting')->name('updateSetting');
    Route::post('admin/aboutme/update','App\Http\Controllers\InformationController@update')->name('updateAboutme');
    Route::post('admin/password/change','App\Http\Controllers\InformationController@changePassword')->name('changePassword');

});