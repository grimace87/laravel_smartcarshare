@extends('layouts.layout_home')

@section('content')

    @if (count($errors))

        <div class="container">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading carshare-subheader-bad">Fix These Issues</div>
                    <div class="panel-body carshare-bad">
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    @endif

    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">New Location</div>
                <div class="panel-body">
                    <form action="{{ url('locations/new') }}" method="post">
                        {{ csrf_field() }}
						
						<div class="form-group">
                            <label for="txtCouncil">Council</label>
                            <input type="text" class="form-control" id="txtCouncil" name="Council_Name" value="{{ old('Council_Name') }}" placeholder="Type the Council name, or click the map" />
                        </div>
						
						<div class="form-group">
                            <label for="txtContact">Contact Name</label>
                            <input type="text" class="form-control" id="txtContact" name="Contact_Name" value="{{ old('Contact_Name') }}" placeholder="Enter the Council contact's name" />
                        </div>
						<div class="form-group">
                            <label for="txtPhone">Phone No.</label>
                            <input type="text" class="form-control" id="txtPhone" name="Phone_No" value="{{ old('Phone_No') }}" placeholder="Enter the Council's contact number" />
                        </div>
						<div class="form-group">
                            <label for="txtEmail">Email Address</label>
                            <input type="text" class="form-control" id="txtEmail" name="Email_Add" value="{{ old('Email_Add') }}" placeholder="Enter the Council contact's email address" />
                        </div>
						<div class="form-group">
                            <label for="txtAddress">Street Address</label>
                            <input type="text" class="form-control" id="txtAddress" name="Street_Address" value="{{ old('Street_Address') }}" placeholder="Type the house number and street, or click the map"
								oninput="javascript:refreshMarker();" />
                        </div>
						<div class="form-group">
                            <label for="txtSuburb">Suburb</label>
                            <input type="text" class="form-control" id="txtSuburb" name="Suburb" value="{{ old('Suburb') }}" placeholder="Type the suburb, or click the map"
								oninput="javascript:refreshMarker();" />
                        </div>
						<div class="form-group">
                            <label for="txtPostCode">Post Code</label>
                            <input type="text" class="form-control" id="txtPostCode" name="Postcode" value="{{ old('Postcode') }}" placeholder="Type the post code, or click the map"
								oninput="javascript:refreshMarker();" />
                        </div>
						<div class="form-group">
                            <label for="txtLevy">Parking Levy</label>
                            <input type="text" readonly class="form-control" id="txtLevy" name="Parking_Levy_Amt" value="15.0" />
                        </div>
						<div class="form-group">
                            <label for="txtLatitude">Latitude</label>
                            <input type="text" readonly class="form-control" id="txtLatitude" name="Latitude" value="{{ old('Latitude') }}" />
                        </div>
						<div class="form-group">
                            <label for="txtLongitude">Longitude</label>
                            <input type="text" readonly class="form-control" id="txtLongitude" name="Longitude" value="{{ old('Longitude') }}" />
                        </div>
						
                        <input class="carshare-btn" type="submit" value="Add Location" />
                    </form>
                </div>
            </div>
        </div>
    </div>
	
	<div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
					<div id="map" style="height: 40em; width: 100%;"></div>
				</div>
			</div>
		</div>
	</div>
	<script>
		var map, marker, locat, coder;
		function initMap() {
			locat = { lat: -37.8739381, lng: 145.0849068 };
			$('#txtLatitude').val(locat.lat);
			$('#txtLongitude').val(locat.lng);
			map = new google.maps.Map(
				document.getElementById('map'),
				{
					zoom: 16,
					center: locat
				}
			);
			marker = new google.maps.Marker({
				position: locat,
				map: null
			});
			google.maps.event.addListener(map, 'click', function(event) {
				//updateMarker(event.latLng);
				coder = new google.maps.Geocoder();
				coder.geocode(
					{location: event.latLng},
					function(results, status) {
						// Return if status wasn't OK
						if (status != 'OK')
							return;
						// Set the latitude and longitude
						$('#txtLatitude').val(results[0].geometry.location.lat);
						$('#txtLongitude').val(results[0].geometry.location.lng);
						marker.setPosition(results[0].geometry.location);
						marker.setMap(map);
						// Scour through the address components and locate relevant things
						//alert(JSON.stringify(results[0]));
						var addrStrNo = '', addrStrStrt = '', addrSuburb = '', addrPostCode = '', addrCouncil;
						var comps = results[0].address_components;
						var compIndex, compsLength = comps.length;
						var types, typeIndex, typesLength;
						for (compIndex = 0; compIndex < compsLength; compIndex++) {
							types = comps[compIndex].types;
							typesLength = types.length;
							for (typeIndex = 0; typeIndex < typesLength; typeIndex++) {
								if (types[typeIndex] == 'street_number') {
									addrStrNo = comps[compIndex].long_name;
									break;
								}
								else if (types[typeIndex] == 'route') {
									addrStrStrt = comps[compIndex].long_name;
									break;
								}
								else if (types[typeIndex] == 'locality') {
									addrSuburb = comps[compIndex].long_name;
									break;
								}
								else if (types[typeIndex] == 'postal_code') {
									addrPostCode = comps[compIndex].long_name;
									break;
								}
								else if (types[typeIndex] == 'administrative_area_level_2') {
									addrCouncil = comps[compIndex].long_name;
									break;
								}
							}
						}
						// Check what was found, and update text fields if appropriate
						if (addrStrNo != '' && addrStrStrt != '') $('#txtAddress').val(addrStrNo + ' ' + addrStrStrt);
						if (addrSuburb != '') $('#txtSuburb').val(addrSuburb);
						if (addrPostCode != '') $('#txtPostCode').val(addrPostCode);
						if (addrCouncil != '') $('#txtCouncil').val(addrCouncil);
					}
				);
			});
		}
		function refreshMarker() {
			// Get details from input form
			var getAddr = $('#txtAddress').val() + ', ' + $('#txtSuburb').val() + ', ' + $('#txtPostCode').val() + ', VIC, Australia';
			// Pass this into the Google Maps Geocoder API
			coder = new google.maps.Geocoder();
			coder.geocode(
				{address: getAddr},
				function(results, status) {
					if (status != 'OK')
						return;
					$('#txtLatitude').val(results[0].geometry.location.lat);
					$('#txtLongitude').val(results[0].geometry.location.lng);
					marker.setPosition(results[0].geometry.location);
					marker.setMap(map);
				}
			);
		}
    </script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBud9bCicBTnSLQqax3ZZDcxf6gacCvyMs&callback=initMap"></script>
	
@endsection
