<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{

	/**
	 * Create a new controller instance with the appropriate middleware.
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

    // Get all staff
    public function all() {
        return view('staff.all', ['staff' => [
            ['staffNo' => '1001', 'lastName' => 'Wilson', 'firstName' => 'Ian',
				'address' => "123 Alan's Schenk", 'suburb' => 'Lake Hylia', 'postCode' => '3003',
				'phone' => '0400123123', 'email' => 'alan@schenk.edu.au', 'position' => 'Manager',
				'dob' => '1992-01-01'],
            ['staffNo' => '1002', 'lastName' => 'Pearce', 'firstName' => 'Ebony',
				'address' => '47 Woodhouse Gve', 'suburb' => 'Ikana Canyon', 'postCode' => '3004',
				'phone' => '0400456456', 'email' => 'darkwood@yahoo.com', 'position' => 'Manager',
				'dob' => '1994-03-12'],
            ['staffNo' => '1003', 'lastName' => 'Duffield', 'firstName' => 'Christine',
				'address' => '8 Santa Rd', 'suburb' => 'Lake Hylia', 'postCode' => '3003',
				'phone' => '0400789789', 'email' => 'cartoonbeer@gmail.com', 'position' => 'Senior Admin',
				'dob' => '1987-05-16'],
            ['staffNo' => '1004', 'lastName' => 'Johncock', 'firstName' => 'Billy',
				'address' => '9 Mikey Way', 'suburb' => 'Ikana Canyon', 'postCode' => '3004',
				'phone' => '0400121212', 'email' => 'bass@chemical.com', 'position' => 'Admin',
				'dob' => '1985-04-04'],
            ['staffNo' => '1005', 'lastName' => 'Houston', 'firstName' => 'Amanda',
				'address' => '5 Gerard Way', 'suburb' => 'Snowhead', 'postCode' => '3005',
				'phone' => '0400131313', 'email' => 'sing@chemical.com', 'position' => 'Admin',
				'dob' => '1986-05-05'],
        ], 'def' => 'No staff to display.']);
    }

	// Show one vehicle with all details
	public function show() {
        return view('staff.show', ['staff' => 
            ['staffNo' => '1001', 'lastName' => 'Wilson', 'firstName' => 'Ian',
				'address' => "123 Alan's Schenk", 'suburb' => 'Lake Hylia', 'postCode' => '3003',
				'phone' => '0400123123', 'email' => 'alan@schenk.edu.au', 'position' => 'Manager',
				'dob' => '1992-01-01']
        ]);
    }
	
    // Get the form to update a staff
    public function updateForm($id) {
        return view('staff.update')->with('id', $id);
    }

    // Update a staff
    public function update($id) {
		
        return StaffController::all();
    }

}
