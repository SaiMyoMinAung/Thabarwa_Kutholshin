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

Auth::routes();

Route::get('/', 'DonateController@index');

Route::post('donation', 'DonationController@save');

Route::group(['middleware' => ['auth:admin'], 'prefix' => 'backend', 'namespace' => 'Backend'], function () {
    Route::get('dashboard', 'DashboardController@index');
    Route::resource('users', 'UserController');

    Route::get('donated_items/{donated_item}/manage', 'DonatedItemController@manage')->name('donated_items.manage');
    Route::post('donated_items/{donated_item}/assign_driver', 'DonatedItemController@assignDriver')->name('donated_items.assign_driver');
    Route::get('donated_items/{donated_item}/arrive_at_office', 'DonatedItemController@arriveAtOffice')->name('donated_items.arrive_at_office');
    Route::resource('donated_items', 'DonatedItemController');
});
