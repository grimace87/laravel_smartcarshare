<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
	// Validation rules, used for the 'new' and 'update' use cases
	private $valRules = [
		'Council_Name' => 'required',
		'Contact_Name' => 'required',
		'Phone_No' => 'required|digits_between:8,12',
		'Email_Add' => 'required|email',
		'Street_Address' => 'required',
		'Suburb' => 'required',
		'Postcode' => 'required|integer|min:1000|max:9999',
		'Parking_Levy_Amt' => 'required|numeric'
	];
	private $valMessages = [
		'Council_Name.required' => 'Please enter the council name.',
		'Contact_Name.required' => 'Please enter the name of the council contact.',
		'Phone_No.required' => 'Please enter the phone number of the council contact.',
		'Phone_No.digits_between' => 'The contact phone number must be from 8 to 12 digits long.',
		'Email_Add.required' => 'Please enter the email address of the council contact.',
		'Email_Add.email' => 'The email address of the council contact must be a valid email address.',
		'Street_Address.required' => 'Please enter the street address.',
		'Suburb.required' => 'Please enter the suburb.',
		'Postcode.required' => 'Please enter the postcode.',
		'Postcode.integer' => 'The postcode must be a 4-digit number.',
		'Postcode.min' => 'The postcode must be a 4-digit number of at least 1000.',
		'Postcode.max' => 'The postcode must be a 4-digit number.',
		'Parking_Levy_Amt.required' => 'Please enter the parking levy amount.',
		'Parking_Levy_Amt.numeric' => 'The parking levy amount must be a number.'
	];

    /**
     * Create a new controller instance with the appropriate middleware.
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    // Get all locations
    public function all() {
        
        $locs = Location::all();
        return view('location.all', ['locs' => $locs, 'def' => 'No locations to display.']);
		
    }

    // Get all locations (filtered)
    public function allFilter($filter) {
        
		switch($filter) {
			case 1:
				$locs = DB::table('locations')->orderBy('Location_Id','asc')->get();
				break;
			case 2:
				$locs = DB::table('locations')->orderBy('Location_Id','desc')->get();
				break;
			case 3:
				$locs = DB::table('locations')->orderBy('Council_Name','asc')->get();
				break;
			case 4:
				$locs = DB::table('locations')->orderBy('Council_Name','desc')->get();
				break;
			default:
				$locs = Location::all();
				break;
		}
        return view('location.all', ['locs' => $locs, 'def' => 'No locations to display.']);
		
    }

	// Show one location with all details
	public function show($id) {
        
		// Get this
        $loc = Location::find($id);
		
		// Get other things that might be nice
		$vehicles = DB::table('vehicles')
			->join('vehicle_types','vehicles.Type_Id','=','vehicle_types.Type_Id')
			->where('Location_Id',$id)
			->get();
		
		// Pass stuff to the view
        return view('location.show', ['loc' => $loc, 'vehix' => $vehicles, 'defNoVehicles' => 'There are no vehicles at this location.']);

    }
	
    // Get the form to add a new location
    public function newForm() {
        
        return view('location.new', []);

    }

    // Add a location
    public function news(Request $request) {
		
        // Validate data
        $this->validate($request, $this->valRules, $this->valMessages);

        // Add the data to a new Model
        $loc = new Location();
        $loc->Council_Name = $request->Council_Name;
        $loc->Contact_Name = $request->Contact_Name;
        $loc->Phone_No = $request->Phone_No;
        $loc->Email_Add = $request->Email_Add;
        $loc->Street_Address = $request->Street_Address;
        $loc->Suburb = $request->Suburb;
        $loc->Postcode = $request->Postcode;
        $loc->Parking_Levy_Amt = $request->Parking_Levy_Amt;
        $loc->Latitude = $request->Latitude;
        $loc->Longitude = $request->Longitude;

        // Store staff member's ID
        $loc->Staff_No = Auth::user()->Staff_No;

        // Save and return to 'View All' page
        $loc->save();
        return redirect('/locations');

    }

    // Get the form to update a location
    public function updateForm($id) {
        
		// Get This
        $loc = Location::find($id);
        $staff = DB::table('staff')->get();

        return view('location.update', ['loc' => $loc, 'staff' => $staff]);

    }

    // Update a location
    public function update(Request $request) {
		
        // Validate data
        $this->validate($request, $this->valRules, $this->valMessages);

        // Find the Model
        $loc = Location::find($request->Location_Id);

        // Update model details and save
		$loc->Council_Name = $request->Council_Name;
		$loc->Contact_Name = $request->Contact_Name;
		$loc->Phone_No = $request->Phone_No;
		$loc->Email_Add = $request->Email_Add;
		$loc->Street_Address = $request->Street_Address;
		$loc->Suburb = $request->Suburb;
		$loc->Postcode = $request->Postcode;
		$loc->Parking_Levy_Amt = $request->Parking_Levy_Amt;
		$loc->Staff_No = $request->Staff_No;
		$loc->Latitude = $request->Latitude;
		$loc->Longitude = $request->Longitude;
		$loc->save();
		
		// Return to 'View All' page
        return redirect('/locations');

    }

    // Confirm deleting a location
    public function confirmDelete($id) {
        
        return view('location.delete')->with('id', $id);
		
    }

    // Actually delete a location
    public function deleteLocation($id) {
		
		Location::find($id)->delete();
        return LocationController::all();
		
    }

}
