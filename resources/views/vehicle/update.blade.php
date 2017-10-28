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
		$vehicle->Rego_No = old('Rego_No');
		$vehicle->Type_Id = old('Type_Id');
		$vehicle->VIN_No = old('VIN_No');
		$vehicle->Odo_Reading = old('Odo_Reading');
		$vehicle->Year = old('Year');
		$vehicle->Location_Id = old('Location_Id');
		$vehicle->Staff_No = old('Staff_No');
		?>
		
    @endif

    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Vehicle {{ $oldRegoNo }} Update</div>
                <div class="panel-body">
                    <form action="{{ url('vehicles/update') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" class="form-control" name="Old_Rego_No" value="{{ $oldRegoNo }}" />
                        <input type="hidden" class="form-control" name="Date_Acquired" value="{{ $vehicle->Date_Acquired }}" />
                        
						<div class="form-group">
                            <label for="txtRego">Registration Number</label>
                            <input type="text" class="form-control" id="txtRego" name="Rego_No" value="{{ $vehicle->Rego_No }}" />
                        </div>
						<div class="form-group">
                            <label for="txtType">Vehicle Type</label>
                            <select class="form-control" id="txtType" name="Type_Id">
                                @foreach ($types as $t)
                                    <option value="{{ $t->Type_Id }}"
                                    @if ($vehicle->Type_Id == $t->Type_Id)
                                        selected
                                    @endif
                                    >{{ $t->Type_Id.' - '.$t->Make.' '.$t->Model.', '.$t->Colour }}</option>
                                @endforeach
                            </select>
                        </div>
						<div class="form-group">
                            <label for="txtVIN">VIN</label>
                            <input type="text" class="form-control" id="txtVIN" name="VIN_No" value="{{ $vehicle->VIN_No }}" />
                        </div>
						<div class="form-group">
                            <label for="txtOdo">Odometer (km)</label>
                            <input type="text" class="form-control" id="txtOdo" name="Odo_Reading" value="{{ $vehicle->Odo_Reading }}" />
                        </div>
						<div class="form-group">
                            <label for="txtYear">Year</label>
                            <input type="text" class="form-control" id="txtYear" name="Year" value="{{ $vehicle->Year }}" />
                        </div>
						<div class="form-group">
                            <label for="txtLoc">Location</label>
                            <select class="form-control" id="txtLoc" name="Location_Id">
                                @foreach ($locations as $l)
                                    <option value="{{ $l->Location_Id }}"
                                    @if ($vehicle->Location_Id == $l->Location_Id)
                                        selected
                                    @endif
                                    >{{ $l->Location_Id.' - '.$l->Street_Address.' ('.$l->Council_Name.')' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="txtStaffNo">Staff No.</label>
                            <select class="form-control" id="txtStaffNo" name="Staff_No">
                                @foreach ($staff as $s)
                                    <option value="{{ $s->Staff_No }}"
                                        @if ($vehicle->Staff_No == $s->Staff_No)
                                            selected
                                        @endif
                                    >{{ $s->Staff_No.' - '.$s->First_Name.' '.$s->Last_Name }}</option>
                                @endforeach
                            </select>
                        </div>
						
                        <input class="carshare-btn" type="submit" value="Update Vehicle" />
                        <a href="{{ url('vehicles') }}"><input type="button" class="carshare-btn" value="Cancel" /></a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
