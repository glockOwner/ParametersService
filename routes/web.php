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

Route::get('/', 'App\Http\Controllers\ParameterController@index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/upload/{iconType}/{parameter}', 'App\Http\Controllers\ParameterController@upload')->name('upload');
Route::post('/delete/{iconType}/{parameter}', 'App\Http\Controllers\ParameterController@delete')->name('delete');
