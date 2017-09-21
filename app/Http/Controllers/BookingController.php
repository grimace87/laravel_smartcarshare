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

class BookingController extends Controller
{

	private $valRules = [
		'Start_Date' => 'required',
		'Start_Time' => 'required',
		'Return_Date' => 'required',
		'Return_Time' => 'required',
		'Fuel_Fee' => 'required|numeric',
		'Insurance_Fee' => 'required|numeric',
		'Total_exGST' => 'nullable|numeric',
		'GST_Amount' => 'nullable|numeric',
		'Booking_Notes' => 'nullable|min:10'
	];
	private $valMessages = [
		'Start_Date.required' => 'Please enter the start date.',
		'Start_Time.required' => 'Please enter the start time.',
		'Return_Date.required' => 'Please enter the return date.',
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

        // DEFAULT _ REPLACE WITH LOGGED-IN STAFF MEMBER
        $book->Staff_No = Auth::user()->Staff_No;

        // Save and return to 'View All' page
        $book->save();
        return redirect('/bookings');

    }

    // Get the form to update a booking
    public function updateForm($id) {

        $book = Booking::find($id);

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
