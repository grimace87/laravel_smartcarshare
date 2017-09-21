<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('archive.members', ['mems' => [
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
        ], 'def' => 'No members to archive.']);
    }

    // Perform archive
    public function archiveMembers() {
		
        return redirect('/');
    }

    // Get all bookings
    public function allBookings() {
        return view('archive.bookings', ['books' => [
            ['bookingNo' => 1, 'rego' => 'ELM678', 'membershipNo' => 'Thomas Reichert',
				'bookingDate' => '2017-08-12 00:00:00', 'startDateTime' => '2017-11-31 10:00:00',
				'startKM' => '', 'finishDateTime' => '2017-12-03 15:00:00',
				'actualReturnDateTime' => '', 'fuelFee' => '40', 'insuranceFee' => '10',
				'totalExGST' => '200', 'amtGST' => '20', 'bookingNotes' => '',
				'paymentNo' => '1', 'staffNo' => ''],
            ['bookingNo' => 2, 'rego' => 'YOG455', 'membershipNo' => 'Thomas Reichert',
				'bookingDate' => '2017-08-12 00:00:00', 'startDateTime' => '2017-09-24 13:00:00',
				'startKM' => '', 'finishDateTime' => '2017-09-26 12:00:00',
				'actualReturnDateTime' => '', 'fuelFee' => '40', 'insuranceFee' => '10',
				'totalExGST' => '200', 'amtGST' => '20', 'bookingNotes' => '',
				'paymentNo' => '1', 'staffNo' => ''],
            ['bookingNo' => 3, 'rego' => 'ELM678', 'membershipNo' => 'Releasio Toad',
				'bookingDate' => '2017-07-24 00:00:00', 'startDateTime' => '2017-08-19 22:30:00',
				'startKM' => '', 'finishDateTime' => '2017-08-20 09:45:00',
				'actualReturnDateTime' => '', 'fuelFee' => '40', 'insuranceFee' => '10',
				'totalExGST' => '200', 'amtGST' => '20', 'bookingNotes' => '',
				'paymentNo' => '1', 'staffNo' => '']
        ], 'def' => 'No bookings to archive.']);
    }

    // Perform archive
    public function archiveBookings() {
		
        return redirect('/');
    }

}
