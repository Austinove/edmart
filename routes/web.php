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

Route::get('/', "Auth\LoginController@showLoginForm")->name('login');
Route::get('/profile', "ProfilesController@index")->name('profile');
Route::get('/expences', 'ExpencesController@index')->name('expences');
Route::get('/expences/fetch', 'ExpencesController@fetch')->name('getExpences');
Route::get('/expences/pending', 'ExpencesController@pending')->name('getPendingExps');
Route::get('/expences/cancelled', 'ExpencesController@cancelled')->name('getCancelledExps');
Route::post('/expences/create', 'ExpencesController@create')->name('createExpences');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');
