@extends('layouts.layout_home')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Location {{ $id }} Update</div>
                <div class="panel-body">
                    <form action="{{ url('locations/update/'.$id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="txtCouncil">Council</label>
                            <input type="text" class="form-control" id="txtCouncil" name="txtCouncil" />
                        </div>
                        <div class="form-group">
                            <label for="txtContact">Contact Name</label>
                            <input type="text" class="form-control" id="txtContact" name="txtContact" />
                        </div>
                        <div class="form-group">
                            <label for="txtPhone">Phone No.</label>
                            <input type="text" class="form-control" id="txtPhone" name="txtPhone" />
                        </div>
                        <div class="form-group">
                            <label for="txtEmail">Email Address</label>
                            <input type="text" class="form-control" id="txtEmail" name="txtEmail" />
                        </div>
                        <div class="form-group">
                            <label for="txtAddress">Street Address</label>
                            <input type="text" class="form-control" id="txtAddress" name="txtAddress" />
                        </div>
                        <div class="form-group">
                            <label for="txtSuburb">Suburb</label>
                            <input type="text" class="form-control" id="txtSuburb" name="txtSuburb" />
                        </div>
                        <div class="form-group">
                            <label for="txtPostCode">Post Code</label>
                            <input type="text" class="form-control" id="txtPostCode" name="txtPostCode" />
                        </div>
                        <div class="form-group">
                            <label for="txtLevy">Parking Levy</label>
                            <input type="text" class="form-control" id="txtLevy" name="txtLevy" />
                        </div>
                        <div class="form-group">
                            <label for="txtStaff">Staff No.</label>
                            <input type="text" class="form-control" id="txtStaff" name="txtStaff" />
                        </div>
                        <input class="carshare-btn" type="submit" value="Update Location" />
                        <a href="{{ url('locations') }}"><input type="button" class="carshare-btn" value="Cancel" /></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
