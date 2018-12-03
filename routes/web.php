<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/pocketsHome', 'PocketController@index')->name('pocketsHome');
Route::get('/goalsHome', 'GoalController@index')->name('goalsHome');
Route::post('transaction', 'AccountController@transactionRequest');
Route::post('startTransaction', 'AccountController@startTransaction');
Route::get('/goalsHome', 'GoalController@index')->name('goalsHome');
Route::post('createPocket', 'PocketController@create');
Route::post('deletePocket', 'PocketController@pocketTransaction');
Route::post('createGoal', 'GoalController@create');
Route::post('deleteGoal', 'GoalController@goalTransaction');
