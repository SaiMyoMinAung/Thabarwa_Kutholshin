<?php

/**
 * Notification Route
 */
Route::get('notifications', 'NotificationController@index')->name('notifications.index');
Route::get('click_notifications/{notification}', 'NotificationController@clickNotifications')->name('notifications.click');

/**
 * Admin Route
 */
Route::get('auth_admin_information', 'AdminController@information')->name('auth.admin.information');

Route::get('dashboard', 'DashboardController@index');
Route::get('my-profile', 'ProfileController@profile')->name('profile');
Route::post('my-profile/{admin}', 'ProfileController@update')->name('profile.update');
// Route::get('search', 'SearchController@index')->name('search.index');

/**
 * Internal Donated Item Record Admin Type
 * Can Access Those Route
 *
 */
Route::group(['middleware' => 'internal.donated.item.record.admintype'], function () {
    Route::resource('internal_donated_items', 'InternalDonatedItemController');
    Route::get('get_internal_donated_items', 'InternalDonatedItemController@getInternalDonatedItems')->name('get.internalDonatedItems');
    Route::get('internal_donated_items/control_available/{internal_donated_item}', 'InternalDonatedItemController@controlAvailableOrLost')->name('control.available');

    Route::resource('share_internal_donated_items', 'ShareInternalDonatedItemController');

    // Route::resource('internal_donated_items/{internal_donated_item}/internal_requested_items', 'InternalRequestedItemController');
    Route::resource('unexpected_persons', 'UnexpectedPersonController');
    Route::resource('item_types', 'ItemTypeController');
    Route::resource('item_sub_types', 'ItemSubTypeController');
    Route::resource('alms_rounds', 'AlmsRoundController');
    Route::get('get_store_list', 'ItemTypeController@getStoreList')->name('get.store.list');

    Route::resource('contributions', 'ContributionController');
    Route::get('contributions/{contribution}/items', 'ContributionController@contributionItemsIndex')->name('contribution.items.index');
    Route::get('contributions/{contribution}/internal_donated_items/{internal_donated_item}/confirm', 'ContributionController@contributionItemsConfirm')->name('contribution.items.confirm');
    Route::get('contributions/{contribution}/internal_donated_items/{internal_donated_item}/remove', 'ContributionController@contributionItemsRemove')->name('contribution.items.remove');
    Route::post('contributions/{contribution}/add_internal_donated_items', 'ContributionController@addInternalDonatedItems')->name('contribution.items.add');

    Route::get('received-contributions', 'ReceivedContributionController@index')->name('received_contributions.index');
    Route::get('received-contributions/{contribution}/items', 'ReceivedContributionController@contributionItemsIndex')->name('received_contributions.items.index');
    Route::get('received-contributions/{contribution}/internal_donated_items/{internal_donated_item}/accept', 'ReceivedContributionController@contributionItemsAccept')->name('contribution.items.accept');
    Route::get('received-contributions/{contribution}/show', 'ReceivedContributionController@show')->name('received_contributions.show');
});

/**
 * Setting Admin Type
 * Can Access Those Route
 *
 */
// need to apply middleware
Route::resource('users', 'UserController');
Route::resource('volunteers', 'VolunteerController');
Route::resource('teams', 'TeamController');
Route::resource('yogis', 'YogiController');

/**For Select2 */
// need to apply middleware
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
Route::get('get_all_wards', 'WardController@getAllWards')->name('wards.fetch');
Route::get('get_all_unexpected_persons', 'UnexpectedPersonController@getAllUnexpectedPersons')->name('unexpected_persons.fetch');
Route::get('get_all_units', 'UnitController@getAllUnits')->name('units.fetch');
Route::get('get_all_item_types', 'ItemTypeController@getAllItemTypes')->name('item_types.fetch');
Route::get('get_all_alms_round', 'AlmsRoundController@getAllAlmsRound')->name('alms_round.fetch');
Route::get('get_all_item_sub_types', 'ItemSubTypeController@getAllItemSubTypes')->name('item_sub_types.fetch');

/**For Datatable detail list */
Route::get('generate-internal-donated-item-list', "GenerateDetailListController@forInternalDonatedItem");
Route::get('generate-share-internal-donated-item-list', "GenerateDetailListController@forShareInternalDonatedItem");


Route::group(['middleware' => 'setting.admintype'], function () {

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
    Route::resource('item_types', 'ItemTypeController');
    Route::resource('item_sub_types', 'ItemSubTypeController');
    Route::resource('alms_rounds', 'AlmsRoundController');
    Route::resource('units', 'UnitController');
});

/**
 * Create Admin
 * Can Access Super Admin Only
 */
Route::group(['middleware' => 'super.admin'], function () {
    Route::resource('admins', 'AdminController');
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
