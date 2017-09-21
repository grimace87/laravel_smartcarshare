<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{

    /**
     * Create a new controller instance with the appropriate middleware.
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    // Get all members
    public function all() {
        return view('member.all', ['mems' => [
            ['memNo' => '100002', 'lastName' => 'Reichert', 'firstName' => 'Thomas',
				'address' => '123 Fake St', 'suburb' => 'Gerudo Valley', 'postCode' => '3002',
				'phone' => '0412345678', 'email' => 'thomas@tmail.com',
				'memberType' => 'Member', 'licenseNo' => '10010001000', 'licenseExp' => '2019-12-31',
				'termsAccepted' => '1', 'termsFilepath' => '', 'acceptanceDate' => '2017-08-20'],
            ['memNo' => '100003', 'lastName' => 'Toad', 'firstName' => 'Releasio',
				'address' => '87 Ah St', 'suburb' => 'Kakariko Village', 'postCode' => '3003',
				'phone' => '0487654321', 'email' => 'imthebest@yahoo.com',
				'memberType' => 'Member', 'licenseNo' => '10020003456', 'licenseExp' => '2018-11-17',
				'termsAccepted' => '1', 'termsFilepath' => '', 'acceptanceDate' => '2016-09-23']
        ], 'def' => 'No members to display.']);
    }

	// Show one member in full
	public function show($id) {
        return view('member.show', ['mem' => 
            ['memNo' => '100002', 'lastName' => 'Reichert', 'firstName' => 'Thomas',
				'address' => '123 Fake St', 'suburb' => 'Gerudo Valley', 'postCode' => '3002',
				'phone' => '0412345678', 'email' => 'thomas@tmail.com',
				'memberType' => 'Member', 'licenseNo' => '10010001000', 'licenseExp' => '2019-12-31',
				'termsAccepted' => '1', 'termsFilepath' => '', 'acceptanceDate' => '2017-08-20']]);
    }
	
    // Get members needing approval
    public function approvals() {
        return view('member.all', ['mems' => [
            
        ], 'def' => 'No members to approve.']);
    }

    // Get members needing renewal
    public function renewals() {
        return view('member.all', ['mems' => [
            
        ], 'def' => 'No members to renew.']);
    }

    // Approve a member
    public function approve($id) {
        return view('member.approve')->with('id', $id);
    }

    // Renew a member
    public function renew($id) {
        return view('member.renew')->with('id', $id);
    }

    // Get the form to update a member
    public function updateForm($id) {
        return view('member.update')->with('id', $id);
    }

    // Update a member
    public function update($id) {
        return MemberController::all();
    }

    // Cancel a member
    public function cancel($id) {
        return view('member.cancel')->with('id', $id);
    }

    // Confirm deleting a member
    public function confirmDelete($id) {
        return view('member.delete')->with('id', $id);
    }

    // Actually delete a member
    public function deleteMember($id) {

        return MemberController::all();
    }

}
