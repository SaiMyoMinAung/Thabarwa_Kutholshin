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
    Route::resource('volunteers', 'VolunteerController');

    /**
     * Donated Item Online API 
     * Assign Driver Step
     * */
    Route::post('assign_driver/{donated_item}', 'DonatedItemOnlineController@assignDriver')->name('donatedItem.assignDriver');
    Route::get('change_pickingup_state/{donated_item}', 'DonatedItemOnlineController@changePickingupState')->name('donatedItem.changePickingupState');
    Route::get('change_done_pickingup_state/{donated_item}', 'DonatedItemOnlineController@changeDonePickingupState')->name('donatedItem.changeDonePickingupState');

    /**
     * Donated Item Online API 
     * Assign Store Keeper Step
     * */
    Route::post('assign_store_keeper/{donated_item}', 'DonatedItemOnlineController@assignStoreKeeper')->name('donatedItem.assignStoreKeeper');
    Route::get('change_storing_state/{donated_item}', 'DonatedItemOnlineController@changeStoringState')->name('donatedItem.changeStoringState');
    Route::get('change_done_storing_state/{donated_item}', 'DonatedItemOnlineController@changeDoneStoringState')->name('donatedItem.changeDoneStoringState');

    /**
     * Donated Item Online API
     * Assign Repairer Step
     */
    Route::post('assign_repairer/{donated_item}', 'DonatedItemOnlineController@assignRepairer')->name('donatedItem.assignRepairer');
    Route::post('required_repair/{donated_item}', 'DonatedItemOnlineController@requiredRepair')->name('donatedItem.requiredRepairState');
    Route::get('change_repairing_state/{donated_item}', 'DonatedItemOnlineController@changeRepairingState')->name('donatedItem.changeRepairingState');
    Route::get('change_done_repairing_state/{donated_item}', 'DonatedItemOnlineController@changeDoneRepairingState')->name('donatedItem.changeDoneRepairingState');

    /**
     * Donated Item Online API
     * Assign Deliver Step
     */
    Route::post('assign_deliver/{donated_item}', 'DonatedItemOnlineController@assignDeliver')->name('donatedItem.assignDeliver');
    Route::get('change_delivering_state/{donated_item}', 'DonatedItemOnlineController@changeDeliveringState')->name('donatedItem.changeDeliveringState');
    Route::get('change_done_delivering_state/{donated_item}', 'DonatedItemOnlineController@changeDoneDeliveringState')->name('donatedItem.changeDoneDeliveringState');

    /**For Select2 */
    Route::get('get_all_volunteers', 'VolunteerController@getAllVolunteers')->name('volunteers.get_all_volunteers');
    Route::get('get_stores_of_auth', 'StoreController@getStoresOfAuth')->name('stores.auth');
    Route::get('get_boxes_of_auth', 'BoxController@getBoxesOfAuth')->name('boxes.auth');

    Route::get('donated_items/{donated_item}/manage', 'DonatedItemController@manage')->name('donated_items.manage');
    Route::post('donated_items/{donated_item}/assign_driver', 'DonatedItemController@assignDriver')->name('donated_items.assign_driver');
    Route::get('donated_items/{donated_item}/arrive_at_office', 'DonatedItemController@arriveAtOffice')->name('donated_items.arrive_at_office');

    Route::resource('donated_items', 'DonatedItemController');

    Route::get('settings', 'SettingController@index');
    Route::resource('cities', 'CityController');
    Route::resource('countries', 'CountryController');
    Route::resource('state_regions', 'StateRegionController');
    Route::resource('offices', 'OfficeController');
    Route::resource('stores', 'StoreController');
    Route::resource('boxes', 'BoxController');
});
