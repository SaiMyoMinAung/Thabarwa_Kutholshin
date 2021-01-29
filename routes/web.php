<?php

use Illuminate\Support\Facades\Auth;
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

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    Auth::routes();
});

Route::get('/', 'DonationController@index');

Route::post('donation', 'DonationController@save');

/**
 * For Select2 Data For Frontend
 */
Route::get('get_countries_for_select2', 'Select2Controller@getCountries')->name('getCountries');
Route::get('get_state_regions_for_select2', 'Select2Controller@getStateRegions')->name('getStateRegions');
Route::get('get_cities_for_select2', 'Select2Controller@getCities')->name('getCities');
Route::get('get_autoselect_country', 'Select2Controller@getAutoSelectCountry')->name('getCountry.autoselect');
Route::get('get_autoselect_state_region', 'Select2Controller@getAutoSelectStateRegion')->name('getStateRegion.autoselect');
Route::get('get_autoselect_city', 'Select2Controller@getAutoSelectCity')->name('getCity.autoselect');
Route::get('get_auto_complete_data', 'Select2Controller@getAutoCompleteData');
