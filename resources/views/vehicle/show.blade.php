@extends('layouts.layout_home')

@section('content')

	<a href="{{ url('vehicles') }}"><input type="button" class="carshare-btn" value="Return to Vehicles" /></a>
	<p></p>

    <table class="table">

        <tr class="carshare-table-hdr">
            <th>Registration Number</th>
            <th>VIN</th>
            <th>Model</th>
            <th>Colour</th>
            <th>Odometer (km)</th>
            <th>Year</th>
            <th>Location</th>
            <th>Date of Acquisition</th>
            <th>Date of Disposal</th>
            <th>Staff No.</th>
        </tr>

		<tr class="carshare-table-row">
			<td>{{ $vehix->Rego_No }}</td>
			<td>{{ $vehix->VIN_No }}</td>
			<td>{{ $vehix->Make.' '.$vehix->Model }}</td>
			<td>{{ $vehix->Colour }}</td>
			<td>{{ $vehix->Odo_Reading }}</td>
			<td>{{ $vehix->Year }}</td>
			<td>{{ $vehix->Street_Address }}</td>
			<td>{{ substr($vehix->Date_Acquired, 0, 10) }}</td>
			<td>{{ substr($vehix->Date_Disposed, 0, 10) }}</td>
			<td>{{ $vehix->Staff_No }}</td>
		</tr>

    </table>
	
	<ul class="list-inline">
		<li><form method="get" action="{{ url('vehicles/update/'.$vehix->Rego_No) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Update" /></form></li>
		<li><form method="get" action="{{ url('vehicles/retire/'.$vehix->Rego_No) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Retire" /></form></li>
		<li><form method="post" action="{{ url('vehicles/delete/'.$vehix->Rego_No) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Delete" /></form></li>
	</ul>
	
@endsection
