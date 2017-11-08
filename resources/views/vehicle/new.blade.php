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
                <div class="panel-heading carshare-subheader">New Vehicle</div>
                <div class="panel-body">
                    <form action="{{ url('vehicles/new') }}" method="post">
                        {{ csrf_field() }}
						
						<div class="form-group">
                            <label for="txtRego">Registration Number</label>
                            <input type="text" class="form-control" id="txtRego" name="Rego_No" value="{{ old('Rego_No') }}" placeholder="Enter a unique registration number" />
                        </div>
						<div class="form-group">
                            <label for="txtType">Vehicle Type</label>
                            <select class="form-control" id="txtType" name="Type_Id">
                                @foreach ($types as $t)
                                    <option value="{{ $t->Type_Id }}"
                                    @if (old('Type_Id') == $t->Type_Id)
                                        selected
                                    @endif
                                    >{{ $t->Type_Id.' - '.$t->Make.' '.$t->Model.', '.$t->Colour }}</option>
                                @endforeach
                            </select>
                        </div>
						<div class="form-group">
                            <label for="txtVIN">VIN</label>
                            <input type="text" class="form-control" id="txtVIN" name="VIN_No" value="{{ old('VIN_No') }}" placeholder="Enter the 17-digit identification number" />
                        </div>
						<div class="form-group">
                            <label for="txtOdo">Odometer (km)</label>
                            <input type="text" class="form-control" id="txtOdo" name="Odo_Reading" value="{{ old('Odo_Reading') }}" placeholder="Enter the current odometer reading" />
                        </div>
						<div class="form-group">
                            <label for="txtYear">Year</label>
                            <input type="text" class="form-control" id="txtYear" name="Year" value="{{ old('Year') }}" placeholder="Enter the year of manufacture" />
                        </div>
						<div class="form-group">
                            <label for="txtLoc">Location</label>
                            <select class="form-control" id="txtLoc" name="Location_Id">
                                @foreach ($locations as $l)
                                    <option value="{{ $l->Location_Id }}"
                                    @if (old('Location_Id') == $l->Location_Id)
                                        selected
                                    @endif
                                    >{{ $l->Location_Id.' - '.$l->Street_Address.' ('.$l->Council_Name.')' }}</option>
                                @endforeach
                            </select>
                        </div>
						
                        <input class="carshare-btn" type="submit" value="Save Vehicle" />
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
