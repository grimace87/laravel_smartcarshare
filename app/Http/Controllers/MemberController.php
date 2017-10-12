<?php

namespace App\Http\Controllers;

use App\MemberMembership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{

    private $valRules = [
        'Last_Name' => 'required|min:2',
        'First_Name' => 'required|min:2',
        'Street_Address' => 'required|min:10',
        'Suburb' => 'required|min:3',
        'Postcode' => 'required|min:4|max:4|numeric',
        'Phone_No' => 'nullable|min:6|max:12|numeric',
        'Email_Add' => 'required|email',
        'Licence_No' => 'required|numeric',
        'Licence_Exp' => 'required',
        'Terms_File_Loc' => 'required',
        'Acceptance_Date' => 'required'
    ];
    private $valMessages = [
        'Last_Name.required' => 'Please enter last name.',
        'Last_Name.min' => 'Please enter at least 2 characters for the last name.',
        'First_Name.required' => 'Please enter first name.',
        'First_Name.min' => 'Please enter at least 2 characters for the first name.',
        'Street_Address.required' => 'Please enter a street address.',
        'Street_Address.min' => 'Please enter at least 10 characters for the street address.',
        'Suburb.required' => 'Please enter the suburb.',
        'Suburb.min' => 'Please enter at least 3 characters for the suburb.',
        'Postcode.required' => 'Please enter the post code.',
        'Postcode.min' => 'Please enter exactly 4 characters for the post code.',
        'Postcode.max' => 'Please enter exactly 4 characters for the post code.',
        'Postcode.numeric' => 'Please enter only numbers for the post code.',
        'Phone_No.min' => 'Please enter at least 6 characters for the phone number.',
        'Phone_No.max' => 'Please enter no more than 12 characters for the phone number.',
        'Phone_No.numeric' => 'Please enter only numbers for the phone number.',
        'Email_Add.required' => 'Please enter an email address.',
        'Email_Add.email' => 'Please enter a valid email address.',
        'Licence_No.required' => 'Please enter the license number.',
        'Licence_No.numeric' => 'Please enter only numbers for the license number.',
        'Licence_Exp.required' => 'Please enter the license expiry date.',
        'Terms_File_Loc.required' => 'Please enter file location of the terms agreement.',
        'Acceptance_Date.required' => 'Please enter the date of acceptance of the terms.'
    ];

    /**
     * Create a new controller instance with the appropriate middleware.
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    // Get all members and memberships
    public function all() {
        $mems = DB::table('members')
            ->join('member_memberships', 'members.Membership_No', '=', 'member_memberships.Membership_No')
            ->join('membership_types', 'member_memberships.MemType_Id', '=', 'membership_types.MemType_Id')
            ->get();
        return view('member.all', ['mems' => $mems, 'def' => 'No members to display.']);
    }

	// Show one membership
	public function show($id, $memType) {
        $mem = DB::table('members')
            ->join('member_memberships', 'members.Membership_No', '=', 'member_memberships.Membership_No')
            ->join('membership_types', 'member_memberships.MemType_Id', '=', 'membership_types.MemType_Id')
            ->where([['members.Membership_No', '=', $id], ['member_memberships.MemType_Id', '=', $memType]])
            ->first();
        return view('member.show', ['mem' => $mem]);
    }

    // Get members needing approval
    public function approvals() {
        $mems = DB::table('members')
            ->join('member_memberships', 'members.Membership_No', '=', 'member_memberships.Membership_No')
            ->join('membership_types', 'member_memberships.MemType_Id', '=', 'membership_types.MemType_Id')
            ->where('member_memberships.Status', 'Pending')
            ->get();
        return view('member.all', ['mems' => $mems, 'def' => 'No members have pending approval.']);
    }

    // Get members needing renewal
    public function renewals() {
        $mems = DB::table('members')
            ->join('member_memberships', 'members.Membership_No', '=', 'member_memberships.Membership_No')
            ->join('membership_types', 'member_memberships.MemType_Id', '=', 'membership_types.MemType_Id')
            ->where('member_memberships.Status', 'Expired')
            ->get();
        return view('member.all', ['mems' => $mems, 'def' => 'No members have expired memberships.']);
    }

    // Approve a member
    public function tryApprove($id, $memType) {
        $mem = MemberMembership::where([['Membership_No', $id], ['MemType_Id', $memType]])->first();
        if ($mem->Status == 'Pending')
            return view('member.approve', ['id' => $id, 'memType' => $memType]);
        else
            return view('member.result', ['msg' => 'Member '.$id.' is not awaiting approval for that membership.']);
    }
    public function approve($id, $memType) {
        $mem = MemberMembership::where([['Membership_No', $id], ['MemType_Id', $memType]])->first();
        $mem->Status = 'Approved';
        $mem->save();
        return view('member.result', ['msg' => 'Approved member '.$id.' under membership type '.$memType.'.']);
    }

    // Renew a member
    public function tryRenew($id, $memType) {
        $mem = MemberMembership::where([['Membership_No', $id], ['MemType_Id', $memType]])->first();
        if ($mem->Status == 'Expired' || $mem->Status == 'Cancelled')
            return view('member.renew', ['id' => $id, 'memType' => $memType]);
        else
            return view('member.result', ['msg' => 'Member '.$id.' does not need to be renewed under that membership.']);
    }
    public function renew($id, $memType) {
        $mem = MemberMembership::where([['Membership_No', $id], ['MemType_Id', $memType]])->first();
        $mem->Status = 'Approved';
        $mem->save();
        return view('member.result', ['msg' => 'Renewed member '.$id.' under membership type '.$memType.'.']);
    }

    // Cancel a member
    public function tryCancel($id, $memType) {
        $mem = MemberMembership::where([['Membership_No', $id], ['MemType_Id', $memType]])->first();
        if ($mem->Status != 'Cancelled')
            return view('member.cancel', ['id' => $id, 'memType' => $memType]);
        else
            return view('member.result', ['msg' => 'Member '.$id.' is already cancelled.']);
    }
    public function cancel($id, $memType) {
        $mem = MemberMembership::where([['Membership_No', $id], ['MemType_Id', $memType]])->first();
        $mem->Status = 'Cancelled';
        $mem->save();
        return view('member.result', ['msg' => 'Cancelled member '.$id.' under membership type '.$memType.'.']);
    }

    // Get the form to update a member
    public function updateForm($id, $memType) {




        $mems = DB::table('member')->join('member_memberships', 'member.Membership_No', '=', 'member_memberships.Membership_No');
        $payTheMoneys = Payment::all();
        $staff = DB::table('staff')->get();

        return view('booking.update', ['book' => $book, 'vehicles' => $vehicles, 'mems' => $mems, 'pays' => $payTheMoneys, 'staff' => $staff]);




        return view('member.update')->with('id', $id);
    }

    // Update a member
    public function update($id, $memType) {
        return MemberController::all();
    }

    // Confirm deleting a member
    public function confirmDelete($id, $memType) {
        return view('member.delete')->with('id', $id);
    }

    // Actually delete a member
    public function deleteMember($id, $memType) {

        return MemberController::all();
    }

}
