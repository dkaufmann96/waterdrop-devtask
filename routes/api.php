<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('listdogs', 'App\Http\Controllers\DogController@index')->middleware('auth.secret');
Route::post('adddog', 'App\Http\Controllers\DogController@store')->middleware('auth.secret');
