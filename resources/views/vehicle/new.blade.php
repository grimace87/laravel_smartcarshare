@extends('layouts.layout_home')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">New Vehicle</div>
                <div class="panel-body">
                    <form action="{{ url('vehicles/new') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="txtRego">Registration Number</label>
                            <input type="text" class="form-control" id="txtRego" name="txtRego" />
                        </div>
                        <div class="form-group">
                            <label for="txtType">Vehicle Type</label>
                            <input type="text" class="form-control" id="txtType" name="txtType" />
                        </div>
                        <div class="form-group">
                            <label for="txtVIN">VIN</label>
                            <input type="text" class="form-control" id="txtVIN" name="txtVIN" />
                        </div>
                        <div class="form-group">
                            <label for="txtClass">Class</label>
                            <input type="text" class="form-control" id="txtClass" name="txtClass" />
                        </div>
                        <div class="form-group">
                            <label for="txtOdo">Odometer (km)</label>
                            <input type="text" class="form-control" id="txtOdo" name="txtOdo" />
                        </div>
                        <div class="form-group">
                            <label for="txtTrans">Transmission</label>
                            <input type="text" class="form-control" id="txtTrans" name="txtTrans" />
                        </div>
                        <div class="form-group">
                            <label for="txtYear">Year</label>
                            <input type="text" class="form-control" id="txtYear" name="txtYear" />
                        </div>
                        <div class="form-group">
                            <label for="txtLoc">Location</label>
                            <input type="text" class="form-control" id="txtLoc" name="txtLoc" />
                        </div>
                        <div class="form-group">
                            <label for="txtAcq">Date of Acquisition</label>
                            <input type="text" class="form-control" id="txtAcq" name="txtAcq" />
                        </div>
                        <div class="form-group">
                            <label for="txtDisp">Date of Disposal</label>
                            <input type="text" class="form-control" id="txtDisp" name="txtDisp" />
                        </div>
                        <input class="carshare-btn" type="submit" value="Add Vehicle" />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
