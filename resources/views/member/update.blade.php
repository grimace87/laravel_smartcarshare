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

        $mem->Last_Name = old('Last_Name');
        $mem->First_Name = old('First_Name');
        $mem->Street_Address = old('Street_Address');
        $mem->Suburb = old('Suburb');
        $mem->Postcode = old('Postcode');
        $mem->Phone_No = old('Phone_No');
        $mem->Email_Add = old('Email_Add');
        $mem->Licence_No = old('Licence_No');
        $mem->Licence_Exp = old('Licence_Exp');
        $mem->Terms_File_Loc = old('Terms_File_Loc');
        $mem->Acceptance_Date = old('Acceptance_Date');

        $memShip->MemType_Id = old('MemType_Id');
        $memShip->Status = old('Status');
        $memShip->Expiry_Date = old('Expiry_Date');
        $memShip->SmartCard_Issued = old('SmartCard_Issued') == 'on' ? 1 : 0;

        ?>

    @endif

    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Member {{ $id }} Update</div>
                <div class="panel-body">
                    <form action="{{ url('members/update/'.$id.'/'.$oldMemType) }}" method="post">

                        {{ csrf_field() }}
						
                        <input type="hidden" class="form-control" name="Membership_No" value="{{ $id }}" />
                        <input type="hidden" class="form-control" name="Old_Membership_Type" value="{{ $oldMemType }}" />

                        <div class="form-group">
                            <label for="First_Name">First Name</label>
                            <input type="text" class="form-control" id="First_Name" name="First_Name" value="{{ $mem->First_Name }}" placeholder="Enter a given name" />
                        </div>
                        <div class="form-group">
                            <label for="Last_Name">Surname</label>
                            <input type="text" class="form-control" id="Last_Name" name="Last_Name" value="{{ $mem->Last_Name }}" placeholder="Enter a surname" />
                        </div>
                        <div class="form-group">
                            <label for="Street_Address">Street Address</label>
                            <input type="text" class="form-control" id="Street_Address" name="Street_Address" value="{{ $mem->Street_Address }}" placeholder="Enter a house number and street" />
                        </div>
                        <div class="form-group">
                            <label for="Suburb">Suburb</label>
                            <input type="text" class="form-control" id="Suburb" name="Suburb" value="{{ $mem->Suburb }}" placeholder="Enter a suburb" />
                        </div>
                        <div class="form-group">
                            <label for="Postcode">Post Code</label>
                            <input type="text" class="form-control" id="Postcode" name="Postcode" value="{{ $mem->Postcode }}" placeholder="Enter a post code" />
                        </div>
                        <div class="form-group">
                            <label for="Phone_No">Phone No. (optional)</label>
                            <input type="text" class="form-control" id="Phone_No" name="Phone_No" value="{{ $mem->Phone_No }}" placeholder="Enter a contact number, or leave blank" />
                        </div>
                        <div class="form-group">
                            <label for="Email_Add">Email Address</label>
                            <input type="text" class="form-control" id="Email_Add" name="Email_Add" value="{{ $mem->Email_Add }}" placeholder="Type a valid email address" />
                        </div>
                        <div class="form-group">
                            <label for="Licence_No">License No.</label>
                            <input type="text" class="form-control" id="Licence_No" name="Licence_No" value="{{ $mem->Licence_No }}" placeholder="Type the current license number" />
                        </div>
                        <div class="form-group">
                            <label for="pickDate1">License Expiry Date</label>
                            <div class="input-group date" id="dtPicky1">
                                <input type="text" class="form-control" id="pickDate1" name="Licence_Exp">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pickDate2">Agreement Acceptance Date</label>
                            <div class="input-group date" id="dtPicky2">
                                <input type="text" class="form-control" id="pickDate2" name="Acceptance_Date">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Terms_File_Loc">Agreement File Path</label>
                            <input type="text" class="form-control" id="Terms_File_Loc" name="Terms_File_Loc" value="{{ $mem->Terms_File_Loc }}" />
                        </div>

                        <hr>

                        <div class="form-group">
                            <label for="MemType_Id">Membership Type</label>
                            <select class="form-control" id="MemType_Id" name="MemType_Id">
                                @foreach ($memTypes as $t)
                                    <option value="{{ $t->MemType_Id }}"
                                            @if ($memShip->MemType_Id == $t->MemType_Id)
                                            selected
                                            @endif
                                    >{{ $t->MemType_Id.' - '.$t->Type_Name.' (Valid from '.substr($t->Valid_From,0,10).')'  }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Status">Membership Status</label>
                            <select class="form-control" id="Status" name="Status">
                                <option value="Pending"
                                        @if ($memShip->Status == "Pending")
                                            selected
                                        @endif
                                >Pending</option>
                                <option value="Approved"
                                        @if ($memShip->Status == "Approved")
                                        selected
                                        @endif
                                >Approved</option>
                                <option value="Suspended"
                                        @if ($memShip->Status == "Suspended")
                                        selected
                                        @endif
                                >Suspended</option>
                                <option value="Expired"
                                        @if ($memShip->Status == "Expired")
                                        selected
                                        @endif
                                >Expired</option>
                                <option value="Cancelled"
                                        @if ($memShip->Status == "Cancelled")
                                        selected
                                        @endif
                                >Cancelled</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pickDate3">Membership Expiry Date</label>
                            <div class="input-group date" id="dtPicky3">
                                <input type="text" class="form-control" id="pickDate3" name="Expiry_Date">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="SmartCard_Issued">SmartCard Issued</label>
                            <input type="checkbox" class="form-control" id="SmartCard_Issued" name="SmartCard_Issued"
                                    @if ($memShip->SmartCard_Issued == 1)
                                    checked
                                    @endif
                            />
                        </div>

                        <input class="carshare-btn" type="submit" value="Update Membership" />
                        <a href="{{ url('members') }}"><input type="button" class="carshare-btn" value="Cancel" /></a>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var licExpDate = '{{ $mem->Licence_Exp }}';
        var memAgreeDate = '{{ $mem->Acceptance_Date }}';
        var shipExpDate = '{{ $memShip->Expiry_Date }}';
        $("#dtPicky1").datetimepicker({format: "YYYY-MM-DD", useCurrent: false, defaultDate: licExpDate});
        $("#dtPicky2").datetimepicker({format: "YYYY-MM-DD", useCurrent: false, defaultDate: memAgreeDate});
        $("#dtPicky3").datetimepicker({format: "YYYY-MM-DD", useCurrent: false, defaultDate: shipExpDate});
    </script>

@endsection
