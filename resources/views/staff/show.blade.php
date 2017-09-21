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
			<td>{{ $staff['staffNo'] }}</td>
			<td>{{ $staff['firstName'].' '.$staff['lastName'] }}</td>
			<td>{{ $staff['address'].', '.$staff['suburb'].', '.$staff['postCode'] }}</td>
			<td>{{ $staff['phone'] }}</td>
			<td>{{ $staff['email'] }}</td>
			<td>{{ $staff['position'] }}</td>
			<td>{{ substr($staff['dob'], 0, 10) }}</td>
		</tr>

    </table>

	<ul class="list-inline">
		<li><form method="get" action="{{ url('staff/update/'.$staff['staffNo']) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Update" /></form></li>
	</ul>
	
@endsection
