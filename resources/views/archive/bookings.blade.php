@extends('layouts.layout_home')

@section('content')

@if (count($books) > 0)

    <table class="table">

        <tr class="carshare-table-hdr">
            <th>Booking No.</th>
            <th>Registration No.</th>
            <th>Membership</th>
            <th>Booking Time</th>
            <th>Start Date</th>
            <th>Start Time</th>
            <th>Finish Date</th>
            <th>Finish Time</th>
            <th>Fuel Fee</th>
            <th>Insurance Fee</th>
            <th>Total (GST excl.)</th>
            <th>GST</th>
            <th>Notes</th>
            <th>Payment ID</th>
            <th>Staff Member</th>
        </tr>

        @foreach ($books as $b)

            <tr class="carshare-table-row">
                <td>{{ $b['bookingNo'] }}</td>
                <td>{{ $b['rego'] }}</td>
                <td>{{ $b['membershipNo'] }}</td>
                <td>{{ $b['bookingDate'] }}</td>
                <td>{{ substr($b['startDateTime'], 0, 10) }}</td>
                <td>{{ substr($b['startDateTime'], 11, 8) }}</td>
                <td>{{ substr($b['finishDateTime'], 0, 10) }}</td>
                <td>{{ substr($b['finishDateTime'], 11, 8) }}</td>
                <td>{{ $b['fuelFee'] }}</td>
                <td>{{ $b['insuranceFee'] }}</td>
                <td>{{ $b['totalExGST'] }}</td>
                <td>{{ $b['amtGST'] }}</td>
                <td>{{ $b['bookingNotes'] }}</td>
                <td>{{ $b['paymentNo'] }}</td>
                <td>{{ $b['staffNo'] }}</td>
            </tr>

        @endforeach

    </table>
	
	<form method="post" action="{{ url('archive/bookings') }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Archive All" /></form>
	
@else

    <div class="container">
        <div class="panel">
            <div class="panel-body">
                {{ $def }}
            </div>
        </div>
    </div>

@endif

@endsection
