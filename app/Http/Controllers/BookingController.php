<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Member;
use App\Payment;
use App\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class BookingController extends Controller
{
	// Validation rules, used for the 'new' and 'update' use cases
	private $valRules = [
		'Start_Date' => 'required|date|after_or_equal:now',
		'Start_Time' => 'required',
		'Return_Date' => 'required|date|after_or_equal:now',
		'Return_Time' => 'required',
		'Fuel_Fee' => 'required|numeric',
		'Insurance_Fee' => 'required|numeric',
		'Total_exGST' => 'nullable|numeric',
		'GST_Amount' => 'nullable|numeric',
		'Booking_Notes' => 'nullable|min:10'
	];
	private $valMessages = [
		'Start_Date.required' => 'Please enter the start date.',
		'Start_Date.date' => 'Please enter a valid start date.',
		'Start_Date.after_or_equal' => 'The start date must be in the future.',
		'Start_Time.required' => 'Please enter the start time.',
		'Return_Date.required' => 'Please enter the return date.',
		'Return_Date.date' => 'Please enter a valid return date.',
		'Return_Date.after_or_equal' => 'The return date must be in the future.',
		'Return_Time.required' => 'Please enter the return time.',
		'Fuel_Fee.required' => 'Please enter the fuel fee.',
		'Fuel_Fee.numeric' => 'The fuel fee must be numeric.',
		'Insurance_Fee.required' => 'Please enter the insurance fee.',
		'Insurance_Fee.numeric' => 'The insurance fee must be numeric.',
		'Total_exGST.numeric' => 'The total fee must be numeric.',
		'GST_Amount.numeric' => 'The GST amount must be numeric.',
		'Booking_Notes.min' => 'The booking notes must be at least 10 characters long, or left blank.'
	];

    /**
     * Create a new controller instance with the appropriate middleware.
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    // Get all bookings from database
    public function all() {

        $books = Booking::all();
        return view('booking.all', ['books' => $books, 'def' => 'No bookings to display.']);

    }

    // Get all bookings (filtered)
    public function allFilter($filter) {
		switch($filter) {
			case 1:
				$books = DB::table('bookings')->orderBy('Booking_No','asc')->get();
				break;
			case 2:
				$books = DB::table('bookings')->orderBy('Booking_No','desc')->get();
				break;
			case 3:
				$books = DB::table('bookings')->orderBy('Rego_No','asc')->get();
				break;
			case 4:
				$books = DB::table('bookings')->orderBy('Rego_No','desc')->get();
				break;
			case 5:
				$books = DB::table('bookings')->orderBy('Membership_No','asc')->get();
				break;
			case 6:
				$books = DB::table('bookings')->orderBy('Membership_No','desc')->get();
				break;
			default:
				$books = Booking::all();
				break;
		}
        return view('booking.all', ['books' => $books, 'def' => 'No bookings to display.']);
    }

	// Show one booking with all details
	public function show($id) {

        $book = Booking::find($id);
        return view('booking.show', ['book' => $book]);

    }
	
    // Get the form to add a new booking
    public function newForm() {

        // Get things to select from in select boxes
        $vehicles = DB::table('vehicles')->join('vehicle_types', 'vehicles.Type_Id', '=', 'vehicle_types.Type_Id')->get();
        $mems = Member::all();
        $payTheMoneys = Payment::all();

        return view('booking.new', ['vehicles' => $vehicles, 'mems' => $mems, 'pays' => $payTheMoneys]);

    }

    // Add a booking
    public function news(Request $request) {

        // Validate data
        $this->validate($request, $this->valRules, $this->valMessages);
		
		// Verify that the start date precedes the finish date
		$dateStart = strtotime($request->Start_Date.' '.$request->Start_Time.':00');
		$dateFinish = strtotime($request->Return_Date.' '.$request->Return_Time.':00');
		if ($dateFinish < $dateStart) {
			// Send an error message back in the same way that a validation failure would
			return redirect()->back()
				->withInput($request->input())
				->with('errors', new MessageBag(['err' => 'The start time must precede the finish time.']));
		}
		
        // Add the data to a new Model
        $book = new Booking();
        $book->Rego_No = $request->Rego_No;
        $book->Membership_No = $request->Membership_No;
        $book->Booking_Date = Carbon::now();
        $book->Start_Date = $request->Start_Date.' '.$request->Start_Time.':00';
        $book->Return_Date = $request->Return_Date.' '.$request->Return_Time.':00';
        $book->Fuel_Fee = $request->Fuel_Fee;
        $book->Insurance_Fee = $request->Insurance_Fee;
        $book->Total_exGST = $request->Total_exGST;
        $book->GST_Amount = $request->GST_Amount;
        $book->Booking_Notes = $request->Booking_Notes;
        $book->Payment_No = $request->Payment_No;

        // Store staff member's ID
        $book->Staff_No = Auth::user()->Staff_No;

        // Save and return to 'View All' page
        $book->save();
        return redirect('/bookings');

    }

    // Get the form to update a booking
    public function updateForm($id) {
		
		// Get This
        $book = Booking::find($id);

		// Get data for combo boxes
        $vehicles = DB::table('vehicles')->join('vehicle_types', 'vehicles.Type_Id', '=', 'vehicle_types.Type_Id')->get();
        $mems = Member::all();
        $payTheMoneys = Payment::all();
        $staff = DB::table('staff')->get();

        return view('booking.update', ['book' => $book, 'vehicles' => $vehicles, 'mems' => $mems, 'pays' => $payTheMoneys, 'staff' => $staff]);

    }

    // Update a booking
    public function update(Request $request) {

        // Validate data
        $this->validate($request, $this->valRules, $this->valMessages);

		// Verify that the start date precedes the finish date
		$dateStart = strtotime($request->Start_Date.' '.$request->Start_Time.':00');
		$dateFinish = strtotime($request->Return_Date.' '.$request->Return_Time.':00');
		$dateDiff = date_diff($dateFinish, $dateStart, false);
		if ($dateDiff->invert !== 0) {
			// Send an error message back in the same way that a validation failure would
			return redirect()->back()
				->withInput($request->input())
				->with('errors', new MessageBag(['err' => 'The start time must precede the finish time.']));
		}
		
        // Find the Model
        $book = Booking::find($request->Booking_No);

        // Check nullable 'Actual' date/time fields
        $actualTime = $request->Actual_Return_Date.' '.$request->Actual_Return_Time;
        if (strlen($actualTime) == 1) $actualTime = null;

        $book->Rego_No = $request->Rego_No;
        $book->Membership_No = $request->Membership_No;
        $book->Start_Date = $request->Start_Date.' '.$request->Start_Time.':00';
        $book->Return_Date = $request->Return_Date.' '.$request->Return_Time.':00';
        $book->Actual_Return_Date = $actualTime;
        $book->Fuel_Fee = $request->Fuel_Fee;
        $book->Insurance_Fee = $request->Insurance_Fee;
        $book->Total_exGST = $request->Total_exGST;
        $book->GST_Amount = $request->GST_Amount;
        $book->Booking_Notes = $request->Booking_Notes;
        $book->Payment_No = $request->Payment_No;
        $book->Staff_No = $request->Staff_No;

        // Save and return to 'View All' page
        $book->save();
        return redirect('/bookings');

    }

    // Confirm deleting a booking
    public function confirmDelete($id) {
        return view('booking.delete')->with('id', $id);
    }

    // Actually delete a booking
    public function deleteBooking($id) {
		Booking::findOrFail($id)->delete();
        return BookingController::all();
    }

}
