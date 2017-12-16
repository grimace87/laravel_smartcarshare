@extends('layouts.layout_home')

@section('content')

@if (count($books) > 0)

	<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body" style="padding: 0px;">

					<table class="table">

						<tr class="carshare-table-hdr">
							<th>Booking Date <br> <a href="{{ url('archive/bookings/filter/1') }}">ᐱ</a> &nbsp; &nbsp; <a href="{{ url('archive/bookings/filter/2') }}">ᐯ</a></th>
							<th>Start Date</th>
							<th>Return Date <br> <a href="{{ url('archive/bookings/filter/3') }}">ᐱ</a> &nbsp; &nbsp; <a href="{{ url('archive/bookings/filter/4') }}">ᐯ</a></th>
							<th>Payment Amount</th>
							<th>Name</th>
							<th>Email</th>
							<th>Rego No.</th>
							<th>Model</th>
						</tr>

						@foreach ($books as $b)

							<tr class="carshare-table-row">
								<td>{{ substr($b->Booking_Date, 0, 10) }}</td>
								<td>{{ substr($b->Start_Date, 0, 10) }}</td>
								<td>{{ substr($b->Actual_Return_Date, 0, 10) }}</td>
								<td>{{ $b->Payment_Amount }}</td>
								<td>{{ $b->First_Name.' '.$b->Last_Name }}</td>
								<td>{{ $b->Email_Add }}</td>
								<td>{{ $b->Rego_No }}</td>
								<td>{{ $b->Make.' '.$b->Model }}</td>
							</tr>

						@endforeach

					</table>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading carshare-subheader">Selection for Archive</div>
				<div class="panel-body">
					<p>This operation cannot be reversed.</p>
				</div>
				<div class="panel-footer">
					<form method="post" action="{{ url('archive/bookings') }}">
						{{ csrf_field() }}
							
						<label for="">Archive Filter</label>
						<select class="form-control" id="Selection_Mode" name="Selection_Mode">
							<option value="MoreThan30" selected>Bookings Completed More Than 30 Days Ago</option>
							<option value="AllCompleted">All Completed Bookings</option>
						</select>
						<br>
						<input type="submit" class="carshare-btn" value="Archive Bookings" />
					</form>
				</div>
			</div>
		</div>
	</div>
	
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

@endsection
