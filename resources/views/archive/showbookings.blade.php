@extends('layouts.layout_home')

@section('content')

@if (count($books) > 0)

    <table class="table">

        <tr class="carshare-table-hdr">
            <th>Booking Date</th>
            <th>Start Date</th>
            <th>Start Odometer</th>
            <th>Return Date</th>
            <th>Return Odometer</th>
            <th>Payment Amount</th>
            <th>Card Name</th>
            <th>Card Expiry Date</th>
            <th>Name</th>
            <th>Email</th>
            <th>License No.</th>
            <th>License Expiry</th>
            <th>Rego No.</th>
            <th>VIN No.</th>
            <th>Model</th>
        </tr>

        @foreach ($books as $b)

            <tr class="carshare-table-row">
                <td>{{ substr($b->Booking_Date, 0, 10) }}</td>
                <td>{{ substr($b->Start_Date, 0, 10) }}</td>
                <td>{{ $b->Start_Klm }}</td>
                <td>{{ substr($b->Actual_Return_Date, 0, 10) }}</td>
                <td>{{ $b->Actual_Return_Klm }}</td>
                <td>{{ $b->Payment_Amount }}</td>
                <td>{{ $b->Card_Name }}</td>
                <td>{{ $b->Exp_Date }}</td>
                <td>{{ $b->First_Name.' '.$b->Last_Name }}</td>
                <td>{{ $b->Email_Add }}</td>
                <td>{{ $b->Licence_No }}</td>
                <td>{{ substr($b->Licence_Exp, 0, 10) }}</td>
                <td>{{ $b->Rego_No }}</td>
                <td>{{ $b->VIN_No }}</td>
                <td>{{ $b->Make.' '.$b->Model }}</td>
            </tr>

        @endforeach

    </table>

@else

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
				<div class="panel-body">
					{{ $def }}
				</div>
            </div>
        </div>
    </div>

@endif
	
@isset($errs)

	<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
				<div class="panel-heading carshare-subheader-bad">Payments were mis-allocated</div>
				<div class="panel-body carshare-bad">
					<p>{{ $errs }} bookings used payments that were attached to other bookings as well.</p>
					<p>Those bookings were archived, but payment records may still be listed.</p>
				</div>
			</div>
		</div>
	</div>

@endisset

@endsection
