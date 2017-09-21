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
    Route::post('/members/cancel/{id}', 'MemberController@cancel');
    Route::post('/members/delete/{id}', 'MemberController@confirmDelete');
    Route::delete('/members/delete/{id}', 'MemberController@deleteMember');

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
    Route::post('/locations/update/{id}', 'LocationController@update');
    Route::post('/locations/delete/{id}', 'LocationController@confirmDelete');
    Route::delete('/locations/delete/{id}', 'LocationController@deleteLocation');

    // Things with staff
    Route::post('/staff/delete/{id}', 'StaffController@confirmDelete');
    Route::delete('/staff/delete/{id}', 'StaffController@deleteStaff');

    // Archiving
    Route::get('/archive/members', 'ArchiveController@allMembers');
    Route::post('/archive/members', 'ArchiveController@archiveMembers');
    Route::get('/archive/bookings', 'ArchiveController@allBookings');
    Route::post('/archive/bookings', 'ArchiveController@archiveBookings');

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
    Route::get('/members/show/{id}', 'MemberController@show');
    Route::get('/members/approvals', 'MemberController@approvals');
    Route::get('/members/renewals', 'MemberController@renewals');
    Route::post('/members/approve/{id}', 'MemberController@approve');
    Route::post('/members/renew/{id}', 'MemberController@renew');
    Route::get('/members/update/{id}', 'MemberController@updateForm');
    Route::post('/members/update/{id}', 'MemberController@update');

    // Things with bookings
    Route::get('/bookings', 'BookingController@all');
    Route::get('/bookings/show/{id}', 'BookingController@show');
    Route::get('/bookings/new', 'BookingController@newForm');
    Route::post('/bookings/new', 'BookingController@news');
    Route::get('/bookings/update/{id}', 'BookingController@updateForm');
    Route::post('/bookings/update', 'BookingController@update');

    // Things with vehicles
    Route::get('/vehicles', 'VehicleController@all');
    Route::get('/vehicles/show/{id}', 'VehicleController@show');
    Route::get('/vehicles/update/{id}', 'VehicleController@updateForm');
    Route::post('/vehicles/update/{id}', 'VehicleController@update');

    // Things with locations
    Route::get('/locations', 'LocationController@all');
    Route::get('/locations/show/{id}', 'LocationController@show');

    // Things with staff
    Route::get('/staff', 'StaffController@all');
    Route::get('/staff/show/{id}', 'StaffController@show');
    Route::get('/staff/new', 'StaffController@newForm');
    Route::post('/staff/new', 'StaffController@news');
    Route::get('/staff/update/{id}', 'StaffController@updateForm');
    Route::post('/staff/update/{id}', 'StaffController@update');

});
