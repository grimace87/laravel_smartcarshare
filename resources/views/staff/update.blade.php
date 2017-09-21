@extends('layouts.layout_home')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Staff {{ $id }} Update</div>
                <div class="panel-body">
                    <form action="{{ url('staff/update/'.$id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="txtFirstName">First Name</label>
                            <input type="text" class="form-control" id="txtFirstName" name="txtFirstName" />
                        </div>
                        <div class="form-group">
                            <label for="txtLastName">Last Name</label>
                            <input type="text" class="form-control" id="txtLastName" name="txtLastName" />
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
                            <label for="txtPhone">Phone No.</label>
                            <input type="text" class="form-control" id="txtPhone" name="txtPhone" />
                        </div>
                        <div class="form-group">
                            <label for="txtEmail">Email Address</label>
                            <input type="text" class="form-control" id="txtEmail" name="txtEmail" />
                        </div>
                        <div class="form-group">
                            <label for="txtPosition">Position</label>
                            <input type="text" class="form-control" id="txtPosition" name="txtPosition" />
                        </div>
                        <div class="form-group">
                            <label for="txtDOB">Date of Birth</label>
                            <input type="text" class="form-control" id="txtDOB" name="txtDOB" />
                        </div>
                        <input class="carshare-btn" type="submit" value="Update Staff" />
                        <a href="{{ url('staff') }}"><input type="button" class="carshare-btn" value="Cancel" /></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
