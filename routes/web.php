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


Route::group(['middleware' => ['auth:admin'], 'prefix' => 'backend', 'namespace' => 'Backend'], function () {

    /**
     * Notification Route
     */
    Route::get('notifications', 'NotificationController@index')->name('notifications.index');
    Route::get('click_notifications/{notification}', 'NotificationController@clickNotifications')->name('notifications.click');


    Route::get('dashboard', 'DashboardController@index');

    /**
     * Setting Admin Type
     * Can Access Those Route
     * 
     */
    Route::group(['middleware' => 'setting.admintype'], function () {
        Route::resource('users', 'UserController');
        Route::resource('volunteers', 'VolunteerController');
        Route::resource('teams', 'TeamController');
        Route::resource('yogis', 'YogiController');

        Route::get('settings', 'SettingController@index');
        Route::resource('cities', 'CityController');
        Route::resource('countries', 'CountryController');
        Route::resource('state_regions', 'StateRegionController');
        Route::resource('offices', 'OfficeController');
        Route::resource('stores', 'StoreController');
        Route::resource('boxes', 'BoxController');
        Route::resource('centers', 'CenterController');
        Route::resource('wards', 'WardController');
        Route::resource('volunteer_jobs', 'VolunteerJobController');
    });

    /**
     * Donated Item Record Admin Type
     * Can Access Those Route
     * 
     */
    Route::group(['middleware' => 'donated.item.record.admintype'], function () {

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
         * Assign Complete Step
         */
        Route::get('assign_complete/{donated_item}', 'DonatedItemOnlineController@assignComplete')->name('donatedItem.assignComplete');
        Route::get('assign_incomplete/{donated_item}', 'DonatedItemOnlineController@assignIncomplete')->name('donatedItem.assignIncomplete');


        /**
         * Requested Item API
         * Assign Deliver Step
         */
        Route::post('assign_deliver/{requested_item}', 'RequestedItemController@assignDeliver')->name('requestedItem.assignDeliver');
        Route::get('change_delivering_state/{requested_item}', 'RequestedItemController@changeDeliveringState')->name('requestedItem.changeDeliveringState');
        Route::get('change_done_delivering_state/{requested_item}', 'RequestedItemController@changeDoneDeliveringState')->name('requestedItem.changeDoneDeliveringState');
        Route::get('change_complete_state/{requested_item}', 'RequestedItemController@changeCompleteState')->name('requestedItem.changeCompleteState');
        Route::get('change_incomplete_state/{requested_item}', 'RequestedItemController@changeInCompleteState')->name('requestedItem.changeInCompleteState');
        Route::get('change_cancel_state/{requested_item}', 'RequestedItemController@changeCancelState')->name('requestedItem.changeCancelState');
        Route::get('recover_requested_item/{requested_item}', 'RequestedItemController@recoverRequestedItem')->name('requestedItem.recoverRequestedItem');

        /**For Select2 */
        Route::get('get_all_volunteers', 'VolunteerController@getAllVolunteers')->name('volunteers.get_all_volunteers');
        Route::get('get_driver_volunteers', 'VolunteerController@getDriverVolunteers')->name('volunteers.get_driver_volunteers');
        Route::get('get_store_keeper_volunteers', 'VolunteerController@getStoreKeeperVolunteers')->name('volunteers.get_store_keeper_volunteers');
        Route::get('get_repairer_volunteers', 'VolunteerController@getRepairerVolunteers')->name('volunteers.get_repairer_volunteers');
        Route::get('get_delivered_volunteers', 'VolunteerController@getDeliveredVolunteers')->name('volunteers.get_delivered_volunteers');
        Route::get('get_stores_of_auth', 'StoreController@getStoresOfAuth')->name('stores.auth');
        Route::get('get_boxes_of_auth', 'BoxController@getBoxesOfAuth')->name('boxes.auth');
        Route::get('requested_items/fetch_requestable_types', 'RequestedItemController@fetchRequestableTypes')->name('requestable_types.fetch');
        Route::get('get_all_users', 'UserController@getAllUsers')->name('users.fetch');
        Route::get('get_all_teams', 'TeamController@getAllTeams')->name('teams.fetch');
        Route::get('get_all_yogis', 'YogiController@getAllYogis')->name('yogis.fetch');

        /**
         * Donated Item And Requested Item API
         */
        Route::get('donated_items/{donated_item}/manage', 'DonatedItemController@manage')->name('donated_items.manage');
        Route::get('donated_items/{donated_item}/requested_items', 'RequestedItemController@index')->name('donated_items.requested_items.index');
        Route::post('donatd_items/{donated_item}/requested_items', 'RequestedItemController@store')->name('requested_items.store');
        Route::get('donated_items/{donated_item}/fetch_requested_items', 'RequestedItemController@fetchRequestItems')->name('donated_items.requested_items.fetch');

        Route::resource('donated_items', 'DonatedItemController');
    });

    /**
     * Donation Record Admin Type
     * Can Access Those Route
     * 
     */
    Route::group(['middleware' => 'donation.record.admintype'], function () {
        Route::resource('donation_records', 'DonationRecordController');
    });
});
