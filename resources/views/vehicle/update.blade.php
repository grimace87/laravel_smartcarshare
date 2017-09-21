@extends('layouts.layout_home')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Vehicle {{ $id }} Update</div>
                <div class="panel-body">
                    <form action="{{ url('vehicles/update/'.$id) }}" method="post">
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
                        <div class="form-group">
                            <label for="txtStaff">Staff No.</label>
                            <input type="text" class="form-control" id="txtStaff" name="txtStaff" />
                        </div>
                        <input class="carshare-btn" type="submit" value="Update Vehicle" />
                        <a href="{{ url('vehicles') }}"><input type="button" class="carshare-btn" value="Cancel" /></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
