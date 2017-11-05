<?php

namespace App\Http\Controllers;

use App\Member;
use App\Booking;
use App\Payment;
use App\ArchMember;
use App\ArchBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArchiveController extends Controller
{

	/**
	 * Create a new controller instance with the appropriate middleware.
	 * @return void
	 */
	public function __construct() {
		$this->middleware('App\Http\Middleware\ManagerMiddleware');
	}

    // Get all members
    public function allMembers() {
        $mems = DB::table('members')
            ->join('member_memberships', 'members.Membership_No', '=', 'member_memberships.Membership_No')
            ->join('membership_types', 'member_memberships.MemType_Id', '=', 'membership_types.MemType_Id')
			->orderBy('members.Membership_No','asc')
            ->get();
        return view('archive.members', ['mems' => $mems, 'def' => 'No members to display.']);
    }

    // Get all members (filtered)
    public function allMembersFilter($filter) {
		
		switch($filter) {
			case 1:
				$mems = DB::table('members')
					->join('member_memberships', 'members.Membership_No', '=', 'member_memberships.Membership_No')
					->join('membership_types', 'member_memberships.MemType_Id', '=', 'membership_types.MemType_Id')
					->orderBy('Last_Name','asc')
					->get();
				break;
			case 2:
				$mems = DB::table('members')
					->join('member_memberships', 'members.Membership_No', '=', 'member_memberships.Membership_No')
					->join('membership_types', 'member_memberships.MemType_Id', '=', 'membership_types.MemType_Id')
					->orderBy('Last_Name','desc')
					->get();
				break;
			case 3:
				$mems = DB::table('members')
					->join('member_memberships', 'members.Membership_No', '=', 'member_memberships.Membership_No')
					->join('membership_types', 'member_memberships.MemType_Id', '=', 'membership_types.MemType_Id')
					->orderBy('Status','asc')
					->get();
				break;
			case 4:
				$mems = DB::table('members')
					->join('member_memberships', 'members.Membership_No', '=', 'member_memberships.Membership_No')
					->join('membership_types', 'member_memberships.MemType_Id', '=', 'membership_types.MemType_Id')
					->orderBy('Status','desc')
					->get();
				break;
			default:
				$mems = DB::table('members')
					->join('member_memberships', 'members.Membership_No', '=', 'member_memberships.Membership_No')
					->join('membership_types', 'member_memberships.MemType_Id', '=', 'membership_types.MemType_Id')
					->orderBy('members.Membership_No','asc')
					->get();
				break;
		}
        return view('archive.members', ['mems' => $mems, 'def' => 'No members to display.']);
		
    }

    // Perform archive
    public function archiveMembers(Request $request) {
		// Get members to archive
		$memberSet = null;
		if ($request->Selection_Mode == 'NoCurrent') {
			$memberSet = DB::table('members')
				->whereRaw("Membership_No NOT IN (SELECT DISTINCT Membership_No FROM member_memberships WHERE Status IN ('Pending','Approved','Suspended'))")
				->get();
		}
		else if ($request->Selection_Mode == 'CancelledOrSuspended') {
			$memberSet = DB::table('members')
				->whereRaw("Membership_No NOT IN (SELECT DISTINCT Membership_No FROM member_memberships WHERE Status IN ('Pending','Approved'))")
				->get();
		}
		if ($memberSet != null) {
			$failures = 0;
			foreach ($memberSet as $mem) {
				// Check for un-archived bookings
				$books = DB::table('bookings')
					->where('Membership_No','=',$mem->Membership_No)
					->get();
				if (count($books) > 0)
					$failures++;
				else {
					// Delete any corresponding reviews damage reports and payments
					DB::table('reviews')
						->where('Membership_No','=',$mem->Membership_No)
						->delete();
					DB::table('damage_reports')
						->where('Membership_No','=',$mem->Membership_No)
						->delete();
					DB::table('payments')
						->where('Membership_No','=',$mem->Membership_No)
						->delete();
					// Add the member to the archive
					$arch = new ArchMember();
					$arch->Last_Name = $mem->Last_Name;
					$arch->First_Name = $mem->First_Name;
					$arch->Street_Address = $mem->Street_Address;
					$arch->Suburb = $mem->Suburb;
					$arch->Postcode = $mem->Postcode;
					$arch->Phone_No = $mem->Phone_No;
					$arch->Email_Add = $mem->Email_Add;
					$arch->Licence_No = $mem->Licence_No;
					$arch->Acceptance_Date = $mem->Acceptance_Date;
					if ($arch->save()) {
						// Delete the original records
						DB::table('member_memberships')
							->where('Membership_No','=',$mem->Membership_No)
							->delete();
						Member::find($mem->Membership_No)->delete();
					}
				}
			}
			// Return with an error message if some could not be deleted
			if ($failures > 0) {
				$mems = ArchMember::all();
				return view('archive.showmembers', ['mems' => $mems, 'def' => 'No members to display.', 'errs' => $failures]);
			}
		}
		return redirect('/archive/showmembers');
    }

    // Get all bookings
    public function allBookings() {
        $books = DB::table('bookings')
            ->join('vehicles', 'bookings.Rego_No', '=', 'vehicles.Rego_No')
				->join('vehicle_types', 'vehicles.Type_Id', '=', 'vehicle_types.Type_Id')
            ->join('members', 'bookings.Membership_No', '=', 'members.Membership_No')
			->join('payments', 'bookings.Payment_No', '=', 'payments.Payment_No')
            ->get();
        return view('archive.bookings', ['books' => $books, 'def' => 'No bookings to display.']);
    }

    // Get all bookings (filtered)
    public function allBookingsFilter($filter) {
		
		switch($filter) {
			case 1:
				$books = DB::table('bookings')
					->join('vehicles', 'bookings.Rego_No', '=', 'vehicles.Rego_No')
						->join('vehicle_types', 'vehicles.Type_Id', '=', 'vehicle_types.Type_Id')
					->join('members', 'bookings.Membership_No', '=', 'members.Membership_No')
					->join('payments', 'bookings.Payment_No', '=', 'payments.Payment_No')
					->orderBy('Booking_Date','asc')->get();
				break;
			case 2:
				$books = DB::table('bookings')
					->join('vehicles', 'bookings.Rego_No', '=', 'vehicles.Rego_No')
						->join('vehicle_types', 'vehicles.Type_Id', '=', 'vehicle_types.Type_Id')
					->join('members', 'bookings.Membership_No', '=', 'members.Membership_No')
					->join('payments', 'bookings.Payment_No', '=', 'payments.Payment_No')
					->orderBy('Booking_Date','desc')->get();
				break;
			case 3:
				$books = DB::table('bookings')
					->join('vehicles', 'bookings.Rego_No', '=', 'vehicles.Rego_No')
						->join('vehicle_types', 'vehicles.Type_Id', '=', 'vehicle_types.Type_Id')
					->join('members', 'bookings.Membership_No', '=', 'members.Membership_No')
					->join('payments', 'bookings.Payment_No', '=', 'payments.Payment_No')
					->orderBy('Actual_Return_Date','asc')->get();
				break;
			case 4:
				$books = DB::table('bookings')
					->join('vehicles', 'bookings.Rego_No', '=', 'vehicles.Rego_No')
						->join('vehicle_types', 'vehicles.Type_Id', '=', 'vehicle_types.Type_Id')
					->join('members', 'bookings.Membership_No', '=', 'members.Membership_No')
					->join('payments', 'bookings.Payment_No', '=', 'payments.Payment_No')
					->orderBy('Actual_Return_Date','desc')->get();
				break;
			default:
				$books = DB::table('bookings')
					->join('vehicles', 'bookings.Rego_No', '=', 'vehicles.Rego_No')
						->join('vehicle_types', 'vehicles.Type_Id', '=', 'vehicle_types.Type_Id')
					->join('members', 'bookings.Membership_No', '=', 'members.Membership_No')
					->join('payments', 'bookings.Payment_No', '=', 'payments.Payment_No')
					->get();
				break;
		}
        return view('archive.bookings', ['books' => $books, 'def' => 'No bookings to display.']);
		
    }

    // Perform archive
    public function archiveBookings(Request $request) {
		// Get bookings to archive
		$bookingSet = null;
		if ($request->Selection_Mode == 'MoreThan30') {
			$bookingSet = DB::table('bookings')
				->join('vehicles', 'bookings.Rego_No', '=', 'vehicles.Rego_No')
				->join('vehicle_types', 'vehicles.Type_Id', '=', 'vehicle_types.Type_Id')
				->join('members', 'bookings.Membership_No', '=', 'members.Membership_No')
				->join('payments', 'bookings.Payment_No', '=', 'payments.Payment_No')
				->whereNotNull('Actual_Return_Date')
				->whereRaw('DATE_ADD(Actual_Return_Date, INTERVAL 30 DAY) < NOW()')
				->get();
		}
		else if ($request->Selection_Mode == 'AllCompleted') {
			$bookingSet = DB::table('bookings')
				->join('vehicles', 'bookings.Rego_No', '=', 'vehicles.Rego_No')
				->join('vehicle_types', 'vehicles.Type_Id', '=', 'vehicle_types.Type_Id')
				->join('members', 'bookings.Membership_No', '=', 'members.Membership_No')
				->join('payments', 'bookings.Payment_No', '=', 'payments.Payment_No')
				->whereNotNull('Actual_Return_Date')
				->whereRaw('Actual_Return_Date < NOW()')
				->get();
		}
		if ($bookingSet != null) {
			$failures = 0;
			foreach ($bookingSet as $book) {
				// Add the booking to the archive
				$arch = new ArchBooking();
				$arch->Booking_Date = $book->Booking_Date;
				$arch->Start_Date = $book->Start_Date;
				$arch->Start_Klm = $book->Start_Klm;
				$arch->Actual_Return_Date = $book->Actual_Return_Date;
				$arch->Actual_Return_Klm = $book->Actual_Return_Klm;
				$arch->Payment_Amount = $book->Payment_Amount;
				$arch->Card_Name = $book->Card_Name;
				$arch->Exp_Date = $book->Exp_Date;
				$arch->Last_Name = $book->Last_Name;
				$arch->First_Name = $book->First_Name;
				$arch->Email_Add = $book->Email_Add;
				$arch->Licence_No = $book->Licence_No;
				$arch->Licence_Exp = $book->Licence_Exp;
				$arch->Rego_No = $book->Rego_No;
				$arch->VIN_No = $book->VIN_No;
				$arch->Make = $book->Make;
				$arch->Model = $book->Model;
				if ($arch->save()) {
					// Delete the original record
					Booking::find($book->Booking_No)->delete();
					// Check for the payment being used by multiple bookings
					$pays = DB::table('bookings')
						->where('Payment_No','=',$book->Payment_No)
						->get();
					if (count($pays) > 0)
						$failures++;
					else
						// Delete the corresponding payment
						Payment::find($book->Payment_No)->delete();
				}
			}
			// Return with an error message if some could not be deleted
			if ($failures > 0) {
				$books = ArchBooking::all();
				return view('archive.showbookings', ['books' => $books, 'def' => 'No bookings to display.', 'errs' => $failures]);
			}
		}
		return redirect('/archive/showbookings');
    }
	
	// View archives
	
	public function showMemberArchive() {
		$mems = ArchMember::all();
		return view('archive.showmembers', ['mems' => $mems, 'def' => 'No archived members to display.']);
	}

	public function showBookingArchive() {
		$books = ArchBooking::all();
		return view('archive.showbookings', ['books' => $books, 'def' => 'No archived bookings to display.']);
	}

}
