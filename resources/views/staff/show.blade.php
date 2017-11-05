@extends('layouts.layout_home')

@section('content')

    <a href="{{ url('staff') }}"><input type="button" class="carshare-btn" value="Return to Staff" /></a>
    <p></p>

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
	
	<ul class="list-inline">
		<li><form method="get" action="{{ url('staff/update/'.$staff['Staff_No']) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Update" /></form></li>
	</ul>
	
	@endif
	
@endsection
