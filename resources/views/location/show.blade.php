@extends('layouts.layout_home')

@section('content')

	<a href="{{ url('locations') }}"><input type="button" class="carshare-btn" value="Return to Locations" /></a>
	<p></p>
	
	<div id="map" style="height: 40em; width: 100%;"></div>
	<script>
		function initMap() {
			var location = { lat: {{ $loc['Latitude'] }}, lng: {{ $loc['Longitude'] }} };
			var map = new google.maps.Map(
				document.getElementById('map'),
				{
					zoom: 16,
					center: location
				}
			);
			var marker = new google.maps.Marker({
				position: location,
				map: map
			});
		}
    </script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBud9bCicBTnSLQqax3ZZDcxf6gacCvyMs&callback=initMap"></script>
	
    <table class="table">

        <tr class="carshare-table-hdr">
            <th>Location ID</th>
            <th>Council</th>
            <th>Contact Name</th>
            <th>Phone No.</th>
            <th>Email Address</th>
            <th>Address</th>
            <th>Parking Levy</th>
        </tr>

		<tr class="carshare-table-row">
			<td>{{ $loc['Location_Id'] }}</td>
			<td>{{ $loc['Council_Name'] }}</td>
			<td>{{ $loc['Contact_Name'] }}</td>
			<td>{{ $loc['Phone_No'] }}</td>
			<td>{{ $loc['Email_Add'] }}</td>
			<td>{{ $loc['Street_Address'].', '.$loc['Suburb'].', '.$loc['Postcode'] }}</td>
			<td>{{ $loc['Parking_Levy_Amt'] }}</td>
		</tr>

    </table>

	<ul class="list-inline">
		<li><form method="get" action="{{ url('locations/update/'.$loc['Location_Id']) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Update" /></form></li>
		<li><form method="post" action="{{ url('locations/delete/'.$loc['Location_Id']) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Delete" /></form></li>
	</ul>
	
@endsection
