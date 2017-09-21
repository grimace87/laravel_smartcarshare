<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VehicleController extends Controller
{

    /**
     * Create a new controller instance with the appropriate middleware.
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    // Get all bookings
    public function all() {
        return view('vehicle.all', ['vehix' => [
            ['rego' => 'ELM678', 'typeID' => 'Nissan Shortbox', 'VIN' => 'JCRUD7E00H049723',
				'class' => 'Sedan', 'odometer' => '179000', 'trans' => 'Manual',
				'year' => '1984', 'locID' => 'Karariko',
				'acquiredDateTime' => '2014-03-27 00:00:00', 'disposalDateTime' => '', 'staffNo' => ''],
            ['rego' => 'HWY365', 'typeID' => 'Honda Accent', 'VIN' => 'JTNGU37E01H049791',
				'class' => 'Sedan', 'odometer' => '32000', 'trans' => 'Auto',
				'year' => '2013', 'locID' => 'Karariko',
				'acquiredDateTime' => '2016-11-12 00:00:00', 'disposalDateTime' => '', 'staffNo' => ''],
            ['rego' => 'YOG455', 'typeID' => 'Toyota Corolla', 'VIN' => 'SANBU59E20Y087221',
				'class' => 'Hatchback', 'odometer' => '85000', 'trans' => 'Auto',
				'year' => '2008', 'locID' => 'Gerudo',
				'acquiredDateTime' => '2016-11-12 00:00:00', 'disposalDateTime' => '', 'staffNo' => '']
        ], 'def' => 'No vehicles to display.']);
    }

	// Show one vehicle with all details
	public function show() {
        return view('vehicle.show', ['vehix' =>
            ['rego' => 'ELM678', 'typeID' => 'Nissan Shortbox', 'VIN' => 'JCRUD7E00H049723',
				'class' => 'Sedan', 'odometer' => '179000', 'trans' => 'Manual',
				'year' => '1984', 'locID' => 'Karariko',
				'acquiredDateTime' => '2014-03-27 00:00:00', 'disposalDateTime' => '', 'staffNo' => '']
        ]);
    }
	
    // Get the form to add a new vehicle
    public function newForm() {
        return view('vehicle.new');
    }

    // Add a vehicle
    public function news() {
		
        return VehicleController::all();
    }

    // Get the form to update a vehicle
    public function updateForm($id) {
        return view('vehicle.update')->with('id', $id);
    }

    // Update a vehicle
    public function update($id) {
		
        return VehicleController::all();
    }

    // Confirm deleting a vehicle
    public function confirmDelete($id) {
        return view('vehicle.delete')->with('id', $id);
    }

    // Actually delete a vehicle
    public function deleteVehicle($id) {
		
        return VehicleController::all();
    }

    // Confirm retiring a vehicle
    public function confirmRetire($id) {
        return view('vehicle.retire')->with('id', $id);
    }

    // Actually retire a vehicle
    public function retireVehicle($id) {

        return VehicleController::all();
    }

}
