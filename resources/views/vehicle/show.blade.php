@extends('layouts.layout_home')

@section('content')

	<a href="{{ url('vehicles') }}"><input type="button" class="carshare-btn" value="Return to Vehicles" /></a>
	<p></p>

    <table class="table">

        <tr class="carshare-table-hdr">
            <th>Registration Number</th>
            <th>Vehicle Type</th>
            <th>VIN</th>
            <th>Class</th>
            <th>Odometer (km)</th>
            <th>Transmission</th>
            <th>Year</th>
            <th>Location</th>
            <th>Date of Acquisition</th>
            <th>Date of Disposal</th>
            <th>Staff No.</th>
        </tr>

		<tr class="carshare-table-row">
			<td>{{ $vehix['rego'] }}</td>
			<td>{{ $vehix['typeID'] }}</td>
			<td>{{ $vehix['VIN'] }}</td>
			<td>{{ $vehix['class'] }}</td>
			<td>{{ $vehix['odometer'] }}</td>
			<td>{{ $vehix['trans'] }}</td>
			<td>{{ $vehix['year'] }}</td>
			<td>{{ $vehix['locID'] }}</td>
			<td>{{ substr($vehix['acquiredDateTime'], 0, 10) }}</td>
			<td>{{ substr($vehix['disposalDateTime'], 0, 10) }}</td>
			<td>{{ $vehix['staffNo'] }}</td>
		</tr>

    </table>
	
	<ul class="list-inline">
		<li><form method="get" action="{{ url('vehicles/update/'.$vehix['rego']) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Update" /></form></li>
		<li><form method="get" action="{{ url('vehicles/retire/'.$vehix['rego']) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Retire" /></form></li>
		<li><form method="post" action="{{ url('vehicles/delete/'.$vehix['rego']) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Delete" /></form></li>
	</ul>
	
@endsection
