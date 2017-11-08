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
                <div class="panel-heading carshare-subheader">New Booking</div>
                <div class="panel-body">
                    <form action="{{ url('bookings/new') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="txtRego">Registration No.</label>
                            <select class="form-control" id="txtRego" name="Rego_No">
                                @foreach ($vehicles as $v)
                                    <option value="{{ $v->Rego_No }}"
                                    @if (old('Rego_No') == $v->Rego_No)
                                        selected
                                    @endif
                                    >{{ $v->Rego_No.' - '.$v->Make.' '.$v->Model }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="txtMembershipNo">Membership No.</label>
                            <select class="form-control" id="txtMembershipNo" name="Membership_No">
                                @foreach ($mems as $m)
                                    <option value="{{ $m->Membership_No }}"
                                    @if (old('Membership_No') == $m->Membership_No)
                                        selected
                                    @endif
                                    >{{ $m->Membership_No.' - '.$m->First_Name.' '.$m->Last_Name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="pickDate1">Start Date</label>
							<div class="input-group date" id="dtPicky1">
								<input type="text" class="form-control" id="pickDate1" name="Start_Date" value="{{ old('Start_Date') }}">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
                        </div>
                        <div class="form-group">
                            <label for="pickDate2">Start Time</label>
							<div class="input-group date" id="dtPicky2">
								<input type="text" class="form-control" id="pickDate2" name="Start_Time" value="{{ old('Start_Time') }}">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
								</span>
							</div>
                        </div>
                        <div class="form-group">
                            <label for="pickDate3">Finish Date</label>
							<div class="input-group date" id="dtPicky3">
								<input type="text" class="form-control" id="pickDate3" name="Return_Date" value="{{ old('Return_Date') }}">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
                        </div>
                        <div class="form-group">
                            <label for="pickDate4">Finish Time</label>
							<div class="input-group date" id="dtPicky4">
								<input type="text" class="form-control" id="pickDate4" name="Return_Time" value="{{ old('Return_Time') }}">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
								</span>
							</div>
                        </div>

                        <div class="form-group">
                            <label for="txtFuelFee">Fuel Fee</label>
                            <input type="text" readonly class="form-control" id="txtFuelFee" name="Fuel_Fee" value="20.00" />
                        </div>
                        <div class="form-group">
                            <label for="txtInsuranceFee">Insurance Fee</label>
                            <input type="text" readonly class="form-control" id="txtInsuranceFee" name="Insurance_Fee" value="40.00" />
                        </div>
                        <div class="form-group">
                            <label for="txtTotal">Total (GST excl.)</label>
                            <input type="text" readonly class="form-control" id="txtTotal" name="Total_exGST" value="200.00" />
                        </div>
                        <div class="form-group">
                            <label for="txtPercGST">GST%</label>
                            <input type="text" readonly class="form-control" id="txtPercGST" name="GST_Amount" value="10" />
                        </div>
                        <div class="form-group">
                            <label for="txtNotes">Notes</label>
                            <input type="text" class="form-control" id="txtNotes" name="Booking_Notes" value="{{ old('Booking_Notes') }}" />
                        </div>
                        <div class="form-group">
                            <label for="txtPayNo">Payment No.</label>
                            <select class="form-control" id="txtPayNo" name="Payment_No">
                                @foreach ($pays as $p)
                                    <option value="{{ $p->Payment_No }}"
                                    @if (old('Payment_No') == $p->Payment_No)
                                        selected
                                    @endif
                                    >{{ $p->Payment_No.' - $'.$p->Payment_Amount.' ('.$p->Card_Name.')' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input class="carshare-btn" type="submit" value="Submit Booking" />
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var min = moment();
        $("#dtPicky1").datetimepicker({format: "YYYY-MM-DD"});
        $("#dtPicky2").datetimepicker({format: "HH:mm"});
        $("#dtPicky3").datetimepicker({format: "YYYY-MM-DD"});
        $("#dtPicky4").datetimepicker({format: "HH:mm"});
    </script>

@endsection
