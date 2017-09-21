@extends('layouts.layout_home')

@section('content')

	<a href="{{ url('locations') }}"><input type="button" class="carshare-btn" value="Return to Locations" /></a>
	<p></p>

    <table class="table">

        <tr class="carshare-table-hdr">
            <th>Location ID</th>
            <th>Council</th>
            <th>Contact Name</th>
            <th>Phone No.</th>
            <th>Email Address</th>
            <th>Address</th>
            <th>Parking Levy</th>
            <th>Staff No.</th>
        </tr>

		<tr class="carshare-table-row">
			<td>{{ $loc['id'] }}</td>
			<td>{{ $loc['council'] }}</td>
			<td>{{ $loc['contactName'] }}</td>
			<td>{{ $loc['phoneNo'] }}</td>
			<td>{{ $loc['email'] }}</td>
			<td>{{ $loc['address'].', '.$loc['suburb'].', '.$loc['postCode'] }}</td>
			<td>{{ $loc['parkingLevy'] }}</td>
			<td>{{ $loc['staffNo'] }}</td>
		</tr>

    </table>

	<ul class="list-inline">
		<li><form method="get" action="{{ url('locations/update/'.$loc['id']) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Update" /></form></li>
		<li><form method="post" action="{{ url('locations/delete/'.$loc['id']) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Delete" /></form></li>
	</ul>
	
@endsection
