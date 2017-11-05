<?php

namespace App\Http\Controllers;

use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
	// Validation rules, used for the 'new' and 'update' use cases
	private $valRules = [
		'Last_Name' => 'required|min:2',
		'First_Name' => 'required|min:2',
		'Street_Address' => 'required',
		'Suburb' => 'required',
		'Postcode' => 'required|numeric',
		'Phone_No' => 'nullable|numeric',
		'Email_Add' => 'required|email',
		'Position' => 'required',
		'Date_Birth' => 'required',
		'username' => 'required|min:4'
	];
	private $valMessages = [
		'Last_Name.required' => 'Please enter a surname.',
		'Last_Name.min' => 'Surname must be at least 2 characters',
		'First_Name.required' => 'Please enter a first name.',
		'First_Name.min' => 'First name must be at least 2 characters.',
		'Street_Address.required' => 'Please enter a street address.',
		'Suburb.required' => 'Please enter a suburb.',
		'Postcode.required' => 'Please enter a postcode.',
		'Postcode.numeric' => 'The postcode must be numeric.',
		'Phone_No.numeric' => 'The phone number must be numeric, or left blank.',
		'Email_Add.required' => 'Please enter an email address.',
		'Email_Add.email' => 'The email address does not appear valid.',
		'Position.required' => 'Please select a position.',
		'Date_Birth.required' => 'Please enter a date of birth.',
		'username.required' => 'Please enter a user name.',
		'username.min' => 'The user name must be at least 4 characters.'
	];

	/**
	 * Create a new controller instance with the appropriate middleware.
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

    // Get all staff
    public function all() {
        
        $staff = Staff::all();
        return view('staff.all', ['staff' => $staff, 'def' => 'No staff to display.']);

    }

    // Get all staff (filtered)
    public function allFilter($filter) {
        
		switch($filter) {
			case 1:
				$staff = DB::table('staff')->orderBy('Staff_No','asc')->get();
				break;
			case 2:
				$staff = DB::table('staff')->orderBy('Staff_No','desc')->get();
				break;
			case 3:
				$staff = DB::table('staff')->orderBy('Last_Name','asc')->get();
				break;
			case 4:
				$staff = DB::table('staff')->orderBy('Last_Name','desc')->get();
				break;
			case 5:
				$staff = DB::table('staff')->orderBy('Position','asc')->get();
				break;
			case 6:
				$staff = DB::table('staff')->orderBy('Position','desc')->get();
				break;
			default:
				$staff = Staff::all();
				break;
		}
        return view('staff.all', ['staff' => $staff, 'def' => 'No staff to display.']);
		
    }

	// Show one staff member with all details
	public function show($id) {
        
		$user = Auth::user();
		if ($id != $user->Staff_No && $user->Position != "Manager" && $user->Position != "Senior Admin")
			return view('auth.bad');
		
        $staff = Staff::find($id);
        return view('staff.show', ['staff' => $staff]);

    }
	
    // Get the form to update a staff
    public function updateForm($id) {
        
		// Get This
        $staff = Staff::find($id);

        return view('staff.update', ['staff' => $staff]);

    }

    // Update a staff
    public function update(Request $request) {
		
        // Validate data
        $this->validate($request, $this->valRules, $this->valMessages);

        // Find the Model
        $staff = Staff::find($request->Staff_No);

        // Check nullable 'Phone_No' fields
        $phoneNo = $request->Phone_No;
        if ($phoneNo == '') $phoneNo = null;

        $staff->Last_Name = $request->Last_Name;
        $staff->First_Name = $request->First_Name;
        $staff->Street_Address = $request->Street_Address;
        $staff->Suburb = $request->Suburb;
        $staff->Postcode = $request->Postcode;
        $staff->Phone_No = $phoneNo;
        $staff->Email_Add = $request->Email_Add;
        $staff->Position = $request->Position;
        $staff->Date_Birth = $request->Date_Birth;
        $staff->username = $request->username;
        $staff->Staff_No = $request->Staff_No;

        // Save and return to 'View All' page
        $staff->save();
        return redirect('/staff');

    }

}
