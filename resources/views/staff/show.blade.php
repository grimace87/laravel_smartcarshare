@extends('layouts.layout_home')

@section('content')

	<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
				
                <div class="panel-header carshare-subheader" style="padding: 10px;">
					<a href="{{ url('staff') }}"> &larr; Return to Staff</a>
				</div>

				<div class="panel-body" style="padding: 0px;">

					<table class="table">

						<tr class="carshare-table-hdr">
							<th>Staff ID</th>
							<th>Name</th>
							<th>Address</th>
							<th>Phone No.</th>
							<th>Email Address</th>
							<th>Position</th>
							<th>Date of Birth</th>
							<th></th>
						</tr>

						<tr class="carshare-table-row">
							<td>{{ $staff['Staff_No'] }}</td>
							<td>{{ $staff['First_Name'].' '.$staff['Last_Name'] }}</td>
							<td>{{ $staff['Street_Address'].', '.$staff['Suburb'].', '.$staff['Postcode'] }}</td>
							<td>{{ $staff['Phone_No'] }}</td>
							<td>{{ $staff['Email_Add'] }}</td>
							<td>{{ $staff['Position'] }}</td>
							<td>{{ substr($staff['Date_Birth'], 0, 10) }}</td>
						</tr>

					</table>
	
					@if (Auth::user()->Staff_No == $staff['Staff_No'] || Auth::user()->Position == 'Manager')
	
				</div>
                <div class="panel-footer">
					
					<ul class="list-inline">
						<li><form method="get" action="{{ url('staff/update/'.$staff['Staff_No']) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Update" /></form></li>
					</ul>
	
					@endif
	
				</div>
			</div>
		</div>
	</div>

@endsection
