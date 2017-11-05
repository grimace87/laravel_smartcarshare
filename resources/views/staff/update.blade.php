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
		$staff->Staff_No = old('Staff_No');
		$staff->Last_Name = old('Last_Name');
		$staff->First_Name = old('First_Name');
		$staff->Street_Address = old('Street_Address');
		$staff->Suburb = old('Suburb');
		$staff->Postcode = old('Postcode');
		$staff->Phone_No = old('Phone_No');
		$staff->Email_Add = old('Email_Add');
		$staff->Date_Birth = old('Date_Birth');
		$staff->Position = old('Position');
		$staff->username = old('username');
		?>
		
    @endif

    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Staff {{ $staff->Staff_No }} Update</div>
                <div class="panel-body">
                    <form action="{{ url('staff/update/'.$staff->Staff_No) }}" method="post">
                        {{ csrf_field() }}
						<input type="hidden" class="form-control" name="Staff_No" value="{{ $staff->Staff_No }}" />
                        
						<div class="form-group">
                            <label for="txtLast">Surname</label>
                            <input type="text" class="form-control" id="txtLast" name="Last_Name" value="{{ $staff->Last_Name }}" />
                        </div>
						<div class="form-group">
                            <label for="txtFirst">First Name</label>
                            <input type="text" class="form-control" id="txtFirst" name="First_Name" value="{{ $staff->First_Name }}" />
                        </div>
						<div class="form-group">
                            <label for="txtAddress">Street Address</label>
                            <input type="text" class="form-control" id="txtAddress" name="Street_Address" value="{{ $staff->Street_Address }}" />
                        </div>
						<div class="form-group">
                            <label for="txtSuburb">Suburb</label>
                            <input type="text" class="form-control" id="txtSuburb" name="Suburb" value="{{ $staff->Suburb }}" />
                        </div>
						<div class="form-group">
                            <label for="txtPostcode">Postcode</label>
                            <input type="text" class="form-control" id="txtPostcode" name="Postcode" value="{{ $staff->Postcode }}" />
                        </div>
						<div class="form-group">
                            <label for="txtPhone">Phone Number</label>
                            <input type="text" class="form-control" id="txtPhone" name="Phone_No" value="{{ $staff->Phone_No }}" />
                        </div>
						<div class="form-group">
                            <label for="txtEmail">Email Address</label>
                            <input type="text" class="form-control" id="txtEmail" name="Email_Add" value="{{ $staff->Email_Add }}" />
                        </div>
						<div class="form-group">
                            <label for="txtBirthDate">Date of Birth</label>
							<div class="input-group date" id="dtPicky1">
								<input type="text" class="form-control" id="txtBirthDate" name="Date_Birth">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
                        </div>
						
						@if (Auth::user()->Staff_No == $staff['Staff_No'])
						<input type="hidden" class="form-control" name="Position" value="{{ $staff->Position }}" />
						@else
						<div class="form-group">
                            <label for="txtPosition">Position</label>
                            <select class="form-control" id="txtPosition" name="Position">
							
								<option value="Manager"
									@if ($staff->Position == "Manager")
										selected
									@endif
								>Manager</option>
								
								<option value="Admin"
									@if ($staff->Position == "Admin")
										selected
									@endif
								>Admin</option>
								
								<option value="Senior Admin"
									@if ($staff->Position == "Senior Admin")
										selected
									@endif
								>Senior Admin</option>
								
								<option value="Staff"
									@if ($staff->Position == "Staff")
										selected
									@endif
								>Staff</option>
								
                            </select>
                        </div>
						@endif
						
						<div class="form-group">
                            <label for="txtUser">Username</label>
                            <input type="text" class="form-control" id="txtUser" name="username" value="{{ $staff->username }}" />
                        </div>
						
                        <input class="carshare-btn" type="submit" value="Update Staff" />
                        <a href="{{ url('staff') }}"><input type="button" class="carshare-btn" value="Cancel" /></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
	
    <script>
        var birthdate = '{{ $staff->Date_Birth }}';
        $("#dtPicky1").datetimepicker({format: "YYYY-MM-DD", useCurrent: false, defaultDate: birthdate});
    </script>

@endsection
