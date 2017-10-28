<?php

namespace App\Http\Controllers;

use App\Vehicle;
use App\VehicleType;
use App\Location;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
	// Validation rules, used for the 'new' and 'update' use cases
	private $valRules = [
		'Rego_No' => 'required|min:3|max:8',
		'VIN_No' => 'required|min:17|max:17',
		'Odo_Reading' => 'required|numeric',
		'Year' => 'required|numeric|min:1920|max:2050'
	];
	private $valMessages = [
		'Rego_No.required' => 'Please enter the registration number.',
		'Rego_No.min' => 'Registration number must be at least 3 characters.',
		'Rego_No.max' => 'Registration may not be longer than 8 characters.',
		'VIN_No.required' => 'Please enter the VIN number.',
		'VIN_No.min' => 'VIN number must be exactly 17 characters long.',
		'VIN_No.max' => 'VIN number must be exactly 17 characters long.',
		'Odo_Reading.required' => 'Please enter the current odometer reading.',
		'Odo_Reading.numeric' => 'The odometer reading must be a number.',
		'Year.required' => "Please enter the vehicle's year of manufacture.",
		'Year.numeric' => 'The year of manufacture must be a number.',
		'Year.min' => 'The year of manufacture may not be prior to 1920.',
		'Year.max' => 'The year of manufacture may not, at this stage, be later than 2050.'
	];

    /**
     * Create a new controller instance with the appropriate middleware.
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    // Get all bookings
    public function all() {
		
        $vehix = DB::table('vehicles')->join('locations', 'vehicles.Location_Id', '=', 'locations.Location_Id')->get();
        return view('vehicle.all', ['vehix' => $vehix, 'def' => 'No vehicles to display.']);
		
    }

	// Show one vehicle with all details
	public function show($rego) {
        
        $vehicle = DB::table('vehicles')
			->join('locations', 'vehicles.Location_Id', '=', 'locations.Location_Id')
			->join('vehicle_types', 'vehicles.Type_Id', '=', 'vehicle_types.Type_Id')
			->where('Rego_No',$rego)
			->first();
        return view('vehicle.show', ['vehix' => $vehicle]);

    }
	
    // Get the form to add a new vehicle
    public function newForm() {
        
        // Get things to select from in select boxes
        $types = VehicleType::all();
        $locations = Location::all();

        return view('vehicle.new', ['types' => $types, 'locations' => $locations]);

    }

    // Add a vehicle
    public function news(Request $request) {
		
        // Validate data
        $this->validate($request, $this->valRules, $this->valMessages);

        // Add the data to a new Model
        $vehicle = new Vehicle();
        $vehicle->Rego_No = $request->Rego_No;
        $vehicle->Type_Id = $request->Type_Id;
        $vehicle->VIN_No = $request->VIN_No;
        $vehicle->Odo_Reading = $request->Odo_Reading;
        $vehicle->Year = $request->Year;
        $vehicle->Location_Id = $request->Location_Id;
        $vehicle->Date_Acquired = Carbon::now();
        $vehicle->Date_Disposed = null;

        // Store staff member's ID
        $vehicle->Staff_No = Auth::user()->Staff_No;

        // Save and return to 'View All' page
        $vehicle->save();
        return redirect('/vehicles');

    }

    // Get the form to update a vehicle
    public function updateForm($rego) {
        
		// Get This
        $vehicle = Vehicle::find($rego);

		// Get data for combo boxes
        $types = VehicleType::all();
        $locations = Location::all();
        $staff = DB::table('staff')->get();

        return view('vehicle.update', ['vehicle' => $vehicle, 'types' => $types, 'locations' => $locations, 'staff' => $staff, 'oldRegoNo' => $rego]);

    }

    // Update a vehicle
    public function update(Request $request) {
		
        // Validate data
        $this->validate($request, $this->valRules, $this->valMessages);

        // Find the Model
        $vehicle = Vehicle::find($request->Old_Rego_No);

        // If the rego number hasn't changed, simply save with the other details updated
		if ($request->Old_Rego_No == $request->Rego_No) {
			$vehicle->Type_Id = $request->Type_Id;
			$vehicle->VIN_No = $request->VIN_No;
			$vehicle->Odo_Reading = $request->Odo_Reading;
			$vehicle->Year = $request->Year;
			$vehicle->Location_Id = $request->Location_Id;
			$vehicle->Date_Acquired = $request->Date_Acquired;
			$vehicle->Staff_No = $request->Staff_No;
			$vehicle->save();
		}
		
		// If it has changed, save a new one and delete the old one if successful
		else {
			$newVehicle = new Vehicle();
			$newVehicle->Rego_No = $request->Rego_No;
			$newVehicle->Type_Id = $request->Type_Id;
			$newVehicle->VIN_No = $request->VIN_No;
			$newVehicle->Odo_Reading = $request->Odo_Reading;
			$newVehicle->Year = $request->Year;
			$newVehicle->Location_Id = $request->Location_Id;
			$newVehicle->Date_Acquired = $request->Date_Acquired;
			$newVehicle->Staff_No = $request->Staff_No;
			if ($newVehicle->save())
				$vehicle->delete();
		}
		
		// Return to 'View All' page
        return redirect('/vehicles');

    }

    // Confirm deleting a vehicle
    public function confirmDelete($rego) {
		
        return view('vehicle.delete')->with('rego', $rego);
		
    }

    // Actually delete a vehicle
    public function deleteVehicle($rego) {
		
		Vehicle::find($rego)->delete();
        return VehicleController::all();
		
    }

    // Confirm retiring a vehicle
    public function confirmRetire($rego) {
		
        return view('vehicle.retire')->with('rego', $rego);
		
    }

    // Actually retire a vehicle
    public function retireVehicle($rego) {
		
		$vehicle = Vehicle::find($rego);
		if ($vehicle->Date_Disposed == null) {
			$vehicle->Date_Disposed = Carbon::now();
			$vehicle->save();
		}
        return VehicleController::all();
		
    }

}
