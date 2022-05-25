<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'Pages@index')->name('welcome');



Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::put('/profile/{id}', 'HomeController@editprofile')->name('editprofile');
Route::resource('/expenses', 'ExpenseController');
Route::get('/file-import', 'HomeController@file_import')->name('file_import');
Route::post('/import', 'HomeController@import')->name('import');
