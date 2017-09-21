<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocationController extends Controller
{

    /**
     * Create a new controller instance with the appropriate middleware.
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    // Get all locations
    public function all() {
        return view('location.all', ['locs' => [
            ['id' => 1, 'council' => 'Gerudo', 'contactName' => 'Ganondorf', 'phoneNo' => '666',
				'email' => 'nuffin@why.com', 'address' => '27 Westall Rd',
				'suburb' => 'Gerudo Valley', 'postCode' => '3002',
				'parkingLevy' => '12', 'staffNo' => '1'],
            ['id' => 2, 'council' => 'Kakariko', 'contactName' => 'Ganondorf', 'phoneNo' => '666',
				'email' => 'nuffin@why.com', 'address' => '5 Ernest Rd',
				'suburb' => 'Kakariko Village', 'postCode' => '3003',
				'parkingLevy' => '12', 'staffNo' => '1'],
            ['id' => 3, 'council' => 'Kakariko', 'contactName' => 'Ganondorf', 'phoneNo' => '666',
				'email' => 'nuffin@why.com', 'address' => '7 Ernest Rd',
				'suburb' => 'Kakariko Village', 'postCode' => '3003',
				'parkingLevy' => '12', 'staffNo' => '1'],
            ['id' => 4, 'council' => 'Kakariko', 'contactName' => 'Ganondorf', 'phoneNo' => '666',
				'email' => 'nuffin@why.com', 'address' => '31 Hylian Way',
				'suburb' => 'Kakariko Village', 'postCode' => '3003',
				'parkingLevy' => '12', 'staffNo' => '1']
        ], 'def' => 'No locations to display.']);
    }

	// Show one vehicle with all details
	public function show() {
        return view('location.show', ['loc' =>
            ['id' => 1, 'council' => 'Gerudo', 'contactName' => 'Ganondorf', 'phoneNo' => '666',
				'email' => 'nuffin@why.com', 'address' => '27 Westall Rd',
				'suburb' => 'Gerudo Valley', 'postCode' => '3002',
				'parkingLevy' => '12', 'staffNo' => '1']
        ]);
    }
	
    // Get the form to add a new location
    public function newForm() {
        return view('location.new');
    }

    // Add a location
    public function news() {
		
        return LocationController::all();
    }

    // Get the form to update a location
    public function updateForm($id) {
        return view('location.update')->with('id', $id);
    }

    // Update a location
    public function update($id) {
		
        return LocationController::all();
    }

    // Confirm deleting a location
    public function confirmDelete($id) {
        return view('location.delete')->with('id', $id);
    }

    // Actually delete a location
    public function deleteLocation($id) {
		
        return LocationController::all();
    }

}
