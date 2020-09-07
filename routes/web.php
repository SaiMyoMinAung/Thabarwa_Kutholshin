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

Route::get('/', 'DonateController@index');

Route::post('donation', 'DonationController@save');

Route::group(['prefix' => 'backend', 'namespace' => 'Backend'], function () {
    Route::get('dashboard', 'DashboardController@index');
    Route::resource('users', 'UserController');
    Route::resource('donated_items', 'DonatedItemController');
});
