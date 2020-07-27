<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasksList/{q?}', 'TaskController@index');
Route::post('/tasksList', 'TaskController@store');
Route::get('/tasksList/edit/{id}', 'TaskController@edit');
Route::patch('/tasksList/update/{id}', 'TaskController@update');
Route::delete('/tasks/delete/{id}', 'TaskController@destroy');
