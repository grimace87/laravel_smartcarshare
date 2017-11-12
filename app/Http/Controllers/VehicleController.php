<?php

namespace App\Http\Controllers;

use App\Vehicle;
use App\VehicleType;
use App\Location;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class VehicleController extends Controller
{
	// Validation rules, used for the 'new' and 'update' use cases
	private $valRules = [
		'Rego_No' => 'required|min:3|max:8',
		'VIN_No' => 'required|min:17|max:17',
		'Odo_Reading' => 'required|integer',
		'Year' => 'required|integer|min:1920|max:2050'
	];
	private $valMessages = [
		'Rego_No.required' => 'Please enter the registration number.',
		'Rego_No.min' => 'Registration number must be at least 3 characters.',
		'Rego_No.max' => 'Registration may not be longer than 8 characters.',
		'VIN_No.required' => 'Please enter the VIN number.',
		'VIN_No.min' => 'VIN number must be exactly 17 characters long.',
		'VIN_No.max' => 'VIN number must be exactly 17 characters long.',
		'Odo_Reading.required' => 'Please enter the current odometer reading.',
		'Odo_Reading.integer' => 'The odometer reading must be a whole number.',
		'Year.required' => "Please enter the vehicle's year of manufacture.",
		'Year.integer' => 'The year of manufacture must be a whole number.',
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
		
        $vehix = DB::table('vehicles')
			->join('locations', 'vehicles.Location_Id', '=', 'locations.Location_Id')
			->join('vehicle_types', 'vehicles.Type_Id', '=', 'vehicle_types.Type_Id')
			->get();
        return view('vehicle.all', ['vehix' => $vehix, 'def' => 'No vehicles to display.']);
		
    }

    // Get all vehicles (filtered)
    public function allFilter($filter) {
		
		switch($filter) {
			case 1:
				$vehix = DB::table('vehicles')->join('locations', 'vehicles.Location_Id', '=', 'locations.Location_Id')->orderBy('Rego_No','asc')->get();
				break;
			case 2:
				$vehix = DB::table('vehicles')->join('locations', 'vehicles.Location_Id', '=', 'locations.Location_Id')->orderBy('Rego_No','desc')->get();
				break;
			case 3:
				$vehix = DB::table('vehicles')->join('locations', 'vehicles.Location_Id', '=', 'locations.Location_Id')->orderBy('Odo_Reading','asc')->get();
				break;
			case 4:
				$vehix = DB::table('vehicles')->join('locations', 'vehicles.Location_Id', '=', 'locations.Location_Id')->orderBy('Odo_Reading','desc')->get();
				break;
			default:
				$vehix = DB::table('vehicles')->join('locations', 'vehicles.Location_Id', '=', 'locations.Location_Id')->get();
				break;
		}
        return view('vehicle.all', ['vehix' => $vehix, 'def' => 'No vehicles to display.']);
		
    }

	// Show one vehicle with all details
	public function show($rego) {
        
		// Get this
        $vehicle = DB::table('vehicles')
			->join('locations', 'vehicles.Location_Id', '=', 'locations.Location_Id')
			->join('vehicle_types', 'vehicles.Type_Id', '=', 'vehicle_types.Type_Id')
			->where('Rego_No',$rego)
			->first();
		
		// Get other stuff that might be cool for this thing
		$reports = DB::table('damage_reports')->join('members', 'damage_reports.Membership_No', '=', 'members.Membership_No')->where('Rego_No',$rego)->get();
		$reviews = DB::table('reviews')->join('members', 'reviews.Membership_No', '=', 'members.Membership_No')->where('Rego_No',$rego)->get();
		$books = DB::table('bookings')->join('vehicles', 'bookings.Rego_No', '=', 'vehicles.Rego_No')->join('vehicle_types', 'vehicles.Type_Id', '=', 'vehicle_types.Type_Id')
			->join('members', 'bookings.Membership_No', '=', 'members.Membership_No')->where('bookings.Rego_No',$rego)->whereNull('Actual_Return_Date')->get();
		
		// Make the view
        return view('vehicle.show', [
			'vehix' => $vehicle,
			'reports' => $reports,
			'reviews' => $reviews,
			'books' => $books,
			'defNoReports' => 'There are no damage reports recorded for this vehicle.',
			'defNoReviews' => 'There are no reviews recorded for this vehicle.'
		]);

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

		// Verify unique-ness of the new registration number
		// Check for it in the database
		if (DB::table('vehicles')->where('Rego_No',$request->Rego_No)->get()->count() > 0)
			// Send an error message back in the same way that a validation failure would
			return redirect()->back()
				->withInput($request->input())
				->with('errors', new MessageBag(['err' => 'That registration number is already on record.']));
		
		// Do the same for the VIN number
		if (DB::table('vehicles')->where('VIN_No',$request->VIN_No)->get()->count() > 0)
			// Send an error message back in the same way that a validation failure would
			return redirect()->back()
				->withInput($request->input())
				->with('errors', new MessageBag(['err' => 'That VIN is already on record.']));
		
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

		// Verify unique-ness of the VIN if it's been changed
		if ($request->VIN_No != $vehicle->VIN_No) {
			// Check for this in the database
			if (DB::table('vehicles')->where('VIN_No',$request->VIN_No)->get()->count() > 0)
				// Send an error message back in the same way that a validation failure would
				return redirect()->back()
					->withInput($request->input())
					->with('errors', new MessageBag(['err' => 'That VIN is already being used.']));
		}
		
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
			// But first, verify that it's unique
			if ($request->Rego_No != $vehicle->Rego_No) {
				// Check for this in the database
				if (DB::table('vehicles')->where('Rego_No',$request->Rego_No)->get()->count() > 0)
					// Send an error message back in the same way that a validation failure would
					return redirect()->back()
						->withInput($request->input())
						->with('errors', new MessageBag(['err' => 'That registration number is already being used.']));
			}
			// All clear, do the change
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
