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
		
		<?php
		$loc->Council_Name = old('Council_Name');
		$loc->Contact_Name = old('Contact_Name');
		$loc->Phone_No = old('Phone_No');
		$loc->Email_Add = old('Email_Add');
		$loc->Street_Address = old('Street_Address');
		$loc->Suburb = old('Suburb');
		$loc->Postcode = old('Postcode');
		$loc->Parking_Levy_Amt = old('Parking_Levy_Amt');
		$loc->Staff_No = old('Staff_No');
		$loc->Latitude = old('Latitude');
		$loc->Longitude = old('Longitude');
		?>
		
    @endif

    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Location {{ $loc->Location_Id }} Update</div>
                <div class="panel-body">
                    <form action="{{ url('locations/update') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" class="form-control" name="Location_Id" value="{{ $loc->Location_Id }}" />
                        
						<div class="form-group">
                            <label for="txtCouncil">Council</label>
                            <input type="text" class="form-control" id="txtCouncil" name="Council_Name" value="{{ $loc->Council_Name }}" />
                        </div>
						
						<div class="form-group">
                            <label for="txtContact">Contact Name</label>
                            <input type="text" class="form-control" id="txtContact" name="Contact_Name" value="{{ $loc->Contact_Name }}" />
                        </div>
						<div class="form-group">
                            <label for="txtPhone">Phone No.</label>
                            <input type="text" class="form-control" id="txtPhone" name="Phone_No" value="{{ $loc->Phone_No }}" />
                        </div>
						<div class="form-group">
                            <label for="txtEmail">Email Address</label>
                            <input type="text" class="form-control" id="txtEmail" name="Email_Add" value="{{ $loc->Email_Add }}" />
                        </div>
						<div class="form-group">
                            <label for="txtAddress">Street Address</label>
                            <input type="text" class="form-control" id="txtAddress" name="Street_Address" value="{{ $loc->Street_Address }}"
								oninput="javascript:refreshMarker();" />
                        </div>
						<div class="form-group">
                            <label for="txtSuburb">Suburb</label>
                            <input type="text" class="form-control" id="txtSuburb" name="Suburb" value="{{ $loc->Suburb }}"
								oninput="javascript:refreshMarker();" />
                        </div>
						<div class="form-group">
                            <label for="txtPostCode">Post Code</label>
                            <input type="text" class="form-control" id="txtPostCode" name="Postcode" value="{{ $loc->Postcode }}"
								oninput="javascript:refreshMarker();" />
                        </div>
						<div class="form-group">
                            <label for="txtLevy">Parking Levy</label>
                            <input type="text" class="form-control" id="txtLevy" name="Parking_Levy_Amt" value="{{ $loc->Parking_Levy_Amt }}" />
                        </div>
                        <div class="form-group">
                            <label for="txtStaffNo">Staff No.</label>
                            <select class="form-control" id="txtStaffNo" name="Staff_No">
                                @foreach ($staff as $s)
                                    <option value="{{ $s->Staff_No }}"
                                        @if ($loc->Staff_No == $s->Staff_No)
                                            selected
                                        @endif
                                    >{{ $s->Staff_No.' - '.$s->First_Name.' '.$s->Last_Name }}</option>
                                @endforeach
                            </select>
                        </div>
						<div class="form-group">
                            <label for="txtLatitude">Latitude</label>
                            <input type="text" readonly class="form-control" id="txtLatitude" name="Latitude" value="{{ $loc->Latitude }}" />
                        </div>
						<div class="form-group">
                            <label for="txtLongitude">Longitude</label>
                            <input type="text" readonly class="form-control" id="txtLongitude" name="Longitude" value="{{ $loc->Longitude }}" />
                        </div>
						
                        <input class="carshare-btn" type="submit" value="Update Location" />
                        <a href="{{ url('locations') }}"><input type="button" class="carshare-btn" value="Cancel" /></a>
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
			locat = { lat: {{ $loc->Latitude }}, lng: {{ $loc->Longitude }} };
			map = new google.maps.Map(
				document.getElementById('map'),
				{
					zoom: 16,
					center: locat
				}
			);
			marker = new google.maps.Marker({
				position: locat,
				map: map
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
