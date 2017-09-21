@extends('layouts.layout_home')

@section('content')

    <a href="{{ url('bookings') }}"><input type="button" class="carshare-btn" value="Return to Bookings" /></a>
    <p></p>

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
            <th></th>
            <th></th>
        </tr>

		<tr class="carshare-table-row">
			<td>{{ $book['Booking_No'] }}</td>
			<td>{{ $book['Rego_No'] }}</td>
			<td>{{ $book['Membership_No'] }}</td>
			<td>{{ $book['Booking_Date'] }}</td>
			<td>{{ substr($book['Start_Date'], 0, 10) }}</td>
			<td>{{ substr($book['Start_Date'], 11, 8) }}</td>
			<td>{{ substr($book['Return_Date'], 0, 10) }}</td>
			<td>{{ substr($book['Return_Date'], 11, 8) }}</td>
			<td>{{ $book['Fuel_Fee'] }}</td>
			<td>{{ $book['Insurance_Fee'] }}</td>
			<td>{{ $book['Total_exGST'] }}</td>
			<td>{{ $book['GST_Amount'] }}</td>
			<td>{{ $book['Booking_Notes'] }}</td>
			<td>{{ $book['Payment_No'] }}</td>
			<td>{{ $book['Staff_No'] }}</td>
		</tr>

    </table>

	<ul class="list-inline">
		<li><form method="get" action="{{ url('bookings/update/'.$book['Booking_No']) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Update" /></form></li>
		<li><form method="post" action="{{ url('bookings/delete/'.$book['Booking_No']) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Delete" /></form></li>
	</ul>
	
@endsection
