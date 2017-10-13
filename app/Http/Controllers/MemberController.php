<?php

namespace App\Http\Controllers;

use App\Member;
use App\MemberMembership;
use App\MembershipType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{

    private $valRules = [

        'Last_Name' => 'required|min:2',
        'First_Name' => 'required|min:2',
        'Street_Address' => 'required|min:6',
        'Suburb' => 'required|min:3',
        'Postcode' => 'required|numeric',
        'Phone_No' => 'nullable|numeric',
        'Email_Add' => 'required|email',
        'Licence_No' => 'required|numeric',
        'Licence_Exp' => 'required',
        'Terms_File_Loc' => 'required',
        'Acceptance_Date' => 'required',

        'MemType_Id' => 'required',
        'Status' => 'required',
        'Expiry_Date' => 'required'

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
        'Postcode.numeric' => 'Please enter only numbers for the post code.',
        'Phone_No.numeric' => 'Please enter only numbers for the phone number.',
        'Email_Add.required' => 'Please enter an email address.',
        'Email_Add.email' => 'Please enter a valid email address.',
        'Licence_No.required' => 'Please enter the license number.',
        'Licence_No.numeric' => 'Please enter only numbers for the license number.',
        'Licence_Exp.required' => 'Please enter the license expiry date.',
        'Terms_File_Loc.required' => 'Please enter file location of the terms agreement.',
        'Acceptance_Date.required' => 'Please enter the date of acceptance of the terms.',

        'MemType_Id.required' => 'Please enter a valid membership type.',
        'Status.required' => 'Please enter the membership status.',
        'Expiry_Date.required' => 'Please enter the membership expiry date.'

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

        $mem = Member::find($id);
        $memShip = MemberMembership::where([['Membership_No', $id], ['MemType_Id', $memType]])->first();
        $memTypes = MembershipType::all();

        return view('member.update', ['id' => $id, 'oldMemType' => $memType, 'mem' => $mem, 'memShip' => $memShip, 'memTypes' => $memTypes]);
    }

    // Update a member
    public function update(Request $request) {

        // Validate data
        $this->validate($request, $this->valRules, $this->valMessages);

        // Check nullable fields
        if ($request->Phone_No == '') $request->Phone_No = null;

		// Member and membership records need to be saved here - the member one works fine
        $mem = Member::find($request->Membership_No);
        $mem->Last_Name = $request->Last_Name;
        $mem->First_Name = $request->First_Name;
        $mem->Street_Address = $request->Street_Address;
        $mem->Suburb = $request->Suburb;
        $mem->Postcode = $request->Postcode;
        $mem->Phone_No = $request->Phone_No;
        $mem->Email_Add = $request->Email_Add;
        $mem->Licence_No = $request->Licence_No;
        $mem->Licence_Exp = $request->Licence_Exp;
        $mem->Terms_File_Loc = $request->Terms_File_Loc;
        $mem->Acceptance_Date = $request->Acceptance_Date;
        $mem->save();

		// The membership doesn't save properly if the MemType_Id (part of the composite primary key) is modified
		// A way around this is to save the new one as a separate record, and then delete the old copy
		if ($request->Old_Membership_Type == $request->MemType_Id) {
			
			// Membership type was not changed - won't have issues here
			$memShip = MemberMembership::where([['Membership_No', $request->Membership_No], ['MemType_Id', $request->MemType_Id]])->first();
			$memShip->MemType_Id = $request->MemType_Id;
			$memShip->Status = $request->Status;
			$memShip->Expiry_Date = $request->Expiry_Date;
			$memShip->SmartCard_Issued = $request->SmartCard_Issued == 'on' ? 1 : 0;
			$memShip->save();
			
		}
		else {
			
			// Must create a new record, by copying data from the form where available, otherwise from the old record
			$oldRecord = MemberMembership::where([['Membership_No', $request->Membership_No], ['MemType_Id', $request->Old_Membership_Type]])->first();
			$newRecord = new MemberMembership();
			$newRecord->Membership_No = $request->Membership_No;
			$newRecord->MemType_Id = $request->MemType_Id;
			$newRecord->Date_Joined = $oldRecord->Date_Joined;
			$newRecord->Last_Renewed = $oldRecord->Last_Renewed;
			$newRecord->Expiry_Date = $request->Expiry_Date;
			$newRecord->Status = $request->Status;
			$newRecord->SmartCard_Issued = $request->SmartCard_Issued == 'on' ? 1 : 0;
			$newRecord->SmartCard_No = $oldRecord->SmartCard_No;
			
			// Save the new record
			if ($newRecord->save())
			
			// Delete the old record if the new one was successfully saved
				$oldRecord->delete();
			
		}

        // Return to 'View All' page
        return redirect('/members');

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
