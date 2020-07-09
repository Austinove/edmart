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
Route::get('/expenses', 'ExpencesController@index')->name('expenses');
Route::get('/expences/fetch', 'ExpencesController@fetch')->name('getExpences');
// Route::post("expences/edit/{id}", "ExpencesController@update")->name("editExps");
Route::delete("expences/delete/{id}", "ExpencesController@delete")->name("deleteExps");
Route::get('/expences/pending', 'ExpencesController@pending')->name('getPendingExps');
Route::get('/expences/cancelled', 'ExpencesController@cancelled')->name('getCancelledExps');
Route::post('/expences/create', 'ExpencesController@create')->name('createExpences');
Route::post('/expences/recommended', 'ExpencesController@recommend')->name('recommendExpence');
Route::post('/expences/decline', 'ExpencesController@decline')->name('declineExpence');
Route::get('/fetch/recommended/expenses', 'ExpencesController@hrRecommendation')->name('hrRecommendation');
Route::post('/expences/accept', 'ExpencesController@accept')->name('accept');
Route::get('/fetch/expenses/accepted', 'ExpencesController@getAccepted')->name("getAccepted");
Route::post('/expenses/cashOut', 'ExpencesController@cashOut')->name('cashOut');
Route::post('/expences/admin/decline', 'ExpencesController@adminDecline')->name('adminDecline');
Route::post('/expenses/approved/month', 'ExpencesController@approved')->name('approved');
Route::post('/user/approved', 'ExpencesController@userApproved')->name('userApproved');
Route::post('/approved/cancelled', 'ExpencesController@cancelledViewed')->name('cancelledViewed');
Route::post('/edit/user/info', "Auth\RegisterController@editUserInfo")->name('editUserInfo');
Route::post('/edit/user/password', "Auth\RegisterController@editUserPassword")->name('editUserPassword');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');
