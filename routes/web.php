<?php

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

/*
|--------------------------------------------------------------------------
| Creation
|--------------------------------------------------------------------------
|
| This file is created as part of the Laravel framework, changing
| to meet the needs of the SmartCarShare staff application, which is
| being developed by Thomas Reichert, last modified on 20th August 2017
|
*/

// Authorisationness
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');
Route::get('/badauth', 'HomeController@badAuth');

// GROUP STUFF BY MANAGERS

Route::group(['middleware' => ['auth', 'App\Http\Middleware\ManagerMiddleware']], function() {

    // Member things
    Route::post('/members/cancel/{id}/{memType}', 'MemberController@tryCancel');
    Route::post('/members/cancel/confirmed/{id}/{memType}', 'MemberController@cancel');
    Route::post('/members/delete/{id}/{memType}', 'MemberController@confirmDelete');
    Route::delete('/members/delete/{id}/{memType}', 'MemberController@deleteMember');

    // Things with bookings
    Route::post('/bookings/delete/{id}', 'BookingController@confirmDelete');
    Route::delete('/bookings/delete/{id}', 'BookingController@deleteBooking');

    // Things with vehicles
    Route::get('/vehicles/new', 'VehicleController@newForm');
    Route::post('/vehicles/new', 'VehicleController@news');
    Route::post('/vehicles/delete/{id}', 'VehicleController@confirmDelete');
    Route::delete('/vehicles/delete/{id}', 'VehicleController@deleteVehicle');
    Route::get('/vehicles/retire/{id}', 'VehicleController@confirmRetire');
    Route::post('/vehicles/retire/{id}', 'VehicleController@retireVehicle');

    // Things with locations
    Route::get('/locations/new', 'LocationController@newForm');
    Route::post('/locations/new', 'LocationController@news');
    Route::get('/locations/update/{id}', 'LocationController@updateForm');
    Route::post('/locations/update', 'LocationController@update');
    Route::post('/locations/delete/{id}', 'LocationController@confirmDelete');
    Route::delete('/locations/delete/{id}', 'LocationController@deleteLocation');

    // Things with staff
    Route::post('/staff/delete/{id}', 'StaffController@confirmDelete');
    Route::delete('/staff/delete/{id}', 'StaffController@deleteStaff');

    // Archiving
    Route::get('/archive/members', 'ArchiveController@allMembers');
    Route::get('/archive/members/filter/{filter}', 'ArchiveController@allMembersFilter');
    Route::post('/archive/members', 'ArchiveController@archiveMembers');
    Route::get('/archive/bookings', 'ArchiveController@allBookings');
    Route::get('/archive/bookings/filter/{filter}', 'ArchiveController@allBookingsFilter');
    Route::post('/archive/bookings', 'ArchiveController@archiveBookings');
    Route::get('/archive/showmembers', 'ArchiveController@showMemberArchive');
    Route::get('/archive/showbookings', 'ArchiveController@showBookingArchive');

});

// GROUP STUFF BY SENIOR ADMINISTRATORS

Route::group(['middleware' => ['auth', 'App\Http\Middleware\SeniorAdminMiddleware']], function() {

    // Member things

    // Things with bookings

    // Things with vehicles

    // Things with locations

    // Things with staff

    // Archiving

});

// GROUP STUFF BY ADMINISTRATORS

Route::group(['middleware' => ['auth', 'App\Http\Middleware\AdminMiddleware']], function() {

    // Member things

    // Things with bookings

    // Things with vehicles

    // Things with locations

    // Things with staff

    // Archiving

});

// GROUP BY GENERAL LOGGED-IN-NESS

Route::group(['middleware' => 'auth'], function() {

    // Member things
    Route::get('/members', 'MemberController@all');
    Route::get('/members/filter/{filter}', 'MemberController@allFilter');
    Route::get('/members/show/{id}/{memType}', 'MemberController@show');
    Route::get('/members/approvals', 'MemberController@approvals');
    Route::get('/members/renewals', 'MemberController@renewals');
    Route::post('/members/approve/{id}/{memType}', 'MemberController@tryApprove');
    Route::post('/members/approve/confirmed/{id}/{memType}', 'MemberController@approve');
    Route::post('/members/renew/{id}/{memType}', 'MemberController@tryRenew');
    Route::post('/members/renew/confirmed/{id}/{memType}', 'MemberController@renew');
    Route::get('/members/update/{id}/{memType}', 'MemberController@updateForm');
    Route::post('/members/update/{id}/{memType}', 'MemberController@update');

    // Things with bookings
    Route::get('/bookings', 'BookingController@all');
    Route::get('/bookings/filter/{filter}', 'BookingController@allFilter');
    Route::get('/bookings/show/{id}', 'BookingController@show');
    Route::get('/bookings/new', 'BookingController@newForm');
    Route::post('/bookings/new', 'BookingController@news');
    Route::get('/bookings/update/{id}', 'BookingController@updateForm');
    Route::post('/bookings/update', 'BookingController@update');

    // Things with vehicles
    Route::get('/vehicles', 'VehicleController@all');
    Route::get('/vehicles/filter/{filter}', 'VehicleController@allFilter');
    Route::get('/vehicles/show/{id}', 'VehicleController@show');
    Route::get('/vehicles/update/{id}', 'VehicleController@updateForm');
    Route::post('/vehicles/update', 'VehicleController@update');

    // Things with locations
    Route::get('/locations', 'LocationController@all');
    Route::get('/locations/filter/{filter}', 'LocationController@allFilter');
    Route::get('/locations/show/{id}', 'LocationController@show');

    // Things with staff
    Route::get('/staff', 'StaffController@all');
    Route::get('/staff/filter/{filter}', 'StaffController@allFilter');
    Route::get('/staff/show/{id}', 'StaffController@show');
    Route::get('/staff/new', 'StaffController@newForm');
    Route::post('/staff/new', 'StaffController@news');
    Route::get('/staff/update/{id}', 'StaffController@updateForm');
    Route::post('/staff/update/{id}', 'StaffController@update');

	// Things with help
    Route::get('/help', 'HelpController@help');
	
});
