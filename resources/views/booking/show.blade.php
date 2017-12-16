@extends('layouts.layout_home')

@section('content')

	<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
				
                <div class="panel-header carshare-subheader" style="padding: 10px;">
					<a href="{{ url('bookings') }}"> &larr; Return to Bookings</a>
				</div>

				<div class="panel-body" style="padding: 0px;">
					
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
							@if (isset($book['Start_Klm']))
							<th>Start Odometer</th>
							@endif
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
							@if (isset($book['Start_Klm']))
							<td>{{ $book['Start_Klm'].'km' }}</td>
							@endif
						</tr>

					</table>
					
				</div>
				<div class="panel-body" style="padding: 0px;">
					
					<table class="table">

						<tr class="carshare-table-hdr">
							<th>Fuel Fee</th>
							<th>Insurance Fee</th>
							<th>Total (GST excl.)</th>
							<th>GST</th>
							<th>Notes</th>
							<th>Payment ID</th>
							<th>Staff Member</th>
						</tr>

						<tr class="carshare-table-row">
							<td>{{ $book['Fuel_Fee'] }}</td>
							<td>{{ $book['Insurance_Fee'] }}</td>
							<td>{{ $book['Total_exGST'] }}</td>
							<td>{{ $book['GST_Amount'] }}</td>
							<td>{{ $book['Booking_Notes'] }}</td>
							<td>{{ $book['Payment_No'] }}</td>
							<td>{{ $book['Staff_No'] }}</td>
						</tr>

					</table>
					
				</div>
                <div class="panel-footer">
					
					<ul class="list-inline">
						<li><form method="get" action="{{ url('bookings/update/'.$book['Booking_No']) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Update" /></form></li>
						<li><form method="post" action="{{ url('bookings/delete/'.$book['Booking_No']) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Delete" /></form></li>
					</ul>
					
				</div>
			</div>
		</div>
	</div>

@endsection
