<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/','App\Http\Controllers\ScoreController@getScoreUploadForm')->name('scores.get');

Route::get('/scores', 'App\Http\Controllers\ScoreController@getScoreUploadForm')->name('scores.get');
Route::post('/scores/store', 'App\Http\Controllers\ScoreController@uploadScore')->name('scores.store');
Route::any('/scores/destroy/{id}', 'App\Http\Controllers\ScoreController@destroy')->name('scores.destroy');
Route::any('/scores/edit/{id}', 'App\Http\Controllers\ScoreController@edit')->name('scores.edit');
Route::any('/scores/update/{id}', 'App\Http\Controllers\ScoreController@update')->name('scores.update');

