@extends('layouts.layout_home')

@section('content')

@if (count($books) > 0)

	<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body" style="padding: 0px;">

					<table class="table">

						<tr class="carshare-table-hdr">
							<th>Booking No. <br> <a href="{{ url('bookings/filter/1') }}">ᐱ</a> &nbsp; &nbsp; <a href="{{ url('bookings/filter/2') }}">ᐯ</a></th>
							<th>Registration No. <br> <a href="{{ url('bookings/filter/3') }}">ᐱ</a> &nbsp; &nbsp; <a href="{{ url('bookings/filter/4') }}">ᐯ</a></th>
							<th>Membership <br> <a href="{{ url('bookings/filter/5') }}">ᐱ</a> &nbsp; &nbsp; <a href="{{ url('bookings/filter/6') }}">ᐯ</a></th>
							<th>Start Date</th>
							<th>Finish Date</th>
							<th>Notes</th>
							<th></th>
						</tr>

						@foreach ($books as $b)

							<tr class="carshare-table-row">
								<td>{{ $b->Booking_No }}</td>
								<td>{{ $b->Rego_No }}</td>
								<td>{{ $b->Membership_No.' ('.$b->First_Name.' '.$b->Last_Name.')' }}</td>
								<td>{{ substr($b->Start_Date, 0, 10) }}</td>
								<td>{{ substr($b->Return_Date, 0, 10) }}</td>
								<td>{{ $b->Booking_Notes }}</td>
								<td><form method="get" action="{{ url('bookings/show/'.$b->Booking_No) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Details" /></form></td>
							</tr>

						@endforeach

					</table>
				</div>
				<div class="panel-footer">

@else

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body" style="padding: 0px;">
					{{ $def }}
				</div>
				<div class="panel-footer">

@endif

					<form method="get" action="{{ url('bookings/new') }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="New Booking" /></form>
				</div>
			</div>
		</div>
	</div>

@endsection
