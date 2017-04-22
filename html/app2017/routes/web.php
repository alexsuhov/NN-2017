<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::any('/F3_error', function () {
     return view('RCADM.F3_error');
});


Route::get('list/{grid?}', function ($grid = 'users') {
    // from bootstramp
    return view('grid', ['view' => $grid]);
    
    // Only authenticated users may enter...
})->middleware('auth');

// rcadm
Route::resource('rcadm', 'RCADM\EntryApi',      ['except' => ['show', 'edit', 'update']]);
Route::resource('pachet', 'RCADM\PachetApi',    ['only' => ['index', 'show', 'edit']]);

// to export ArchiveEntry
Route::get('scan/{batch}/{template}', 'RCADM\ScanApi@export')->name('scan.export');
Route::resource('scan', 'RCADM\ScanApi',        ['except' => ['store' , 'destroy']]);
Route::resource('field', 'RCADM\CampuriApi',    ['except' => ['show']]);

// auth
Route::get('user/role', 'Auth\UserCrud@role' , ['parameters' => [
    'user' => 'user' , 'role' => 'role'
]])->name('user.role');

Route::resource('role', 'Auth\RoleCrud'); 
Route::resource('user', 'Auth\UserCrud'); 

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/force', 'HomeController@index');
Route::get('/sync', 'RCADM\HelpController@sync');

