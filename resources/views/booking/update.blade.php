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
		$book->Rego_No = old('Rego_No');
		$book->Membership_No = old('Membership_No');
		$book->Start_Date = old('Start_Date');
		$book->Start_Time = old('Start_Time');
		$book->Return_Date = old('Return_Date');
		$book->Return_Time = old('Return_Time');
		$book->Actual_Return_Date = old('Actual_Return_Date');
		$book->Actual_Return_Time = old('Actual_Return_Time');
		$book->Fuel_Fee = old('Fuel_Fee');
		$book->Insurance_Fee = old('Insurance_Fee');
		$book->Total_exGST = old('Total_exGST');
		$book->GST_Amount = old('GST_Amount');
		$book->Booking_Notes = old('Booking_Notes');
		$book->Payment_No = old('Payment_No');
		$book->Staff_No = old('Staff_No');
		?>
		
    @endif

    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Booking {{ $book->Booking_No }} Update</div>
                <div class="panel-body">
                    <form action="{{ url('bookings/update') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" class="form-control" name="Booking_No" value="{{ $book->Booking_No }}" />
                        <input type="hidden" class="form-control" name="Membership_No" value="{{ $book->Membership_No }}" />
                        <div class="form-group">
                            <label for="txtRego">Registration No.</label>
                            <select class="form-control" id="txtRego" name="Rego_No">
                                @foreach ($vehicles as $v)
                                    <option value="{{ $v->Rego_No }}"
                                        @if ($book->Rego_No == $v->Rego_No)
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
                                        @if ($book->Membership_No == $m->Membership_No)
                                            selected
                                        @endif
                                    >{{ $m->Membership_No.' - '.$m->First_Name.' '.$m->Last_Name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="pickDate1">Start Date</label>
							<div class="input-group date" id="dtPicky1">
								<input type="text" class="form-control" id="pickDate1" name="Start_Date">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
                        </div>
                        <div class="form-group">
                            <label for="pickDate2">Start Time</label>
							<div class="input-group date" id="dtPicky2">
								<input type="text" class="form-control" id="pickDate2" name="Start_Time">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
								</span>
							</div>
                        </div>
                        <div class="form-group">
                            <label for="pickDate3">Finish Date</label>
							<div class="input-group date" id="dtPicky3">
								<input type="text" class="form-control" id="pickDate3" name="Return_Date">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
                        </div>
                        <div class="form-group">
                            <label for="pickDate4">Finish Time</label>
							<div class="input-group date" id="dtPicky4">
								<input type="text" class="form-control" id="pickDate4" name="Return_Time">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
								</span>
							</div>
                        </div>

                        <div class="form-group">
                            <label for="txtActualDate">Actual Finish Date</label>
                            <input type="text" class="form-control" id="txtActualDate" name="Actual_Return_Date" value="{{ substr($book->Actual_Return_Date, 0, 10) }}" />
                        </div>
                        <div class="form-group">
                            <label for="txtActualTime">Actual Finish Time</label>
                            <input type="text" class="form-control" id="txtActualTime" name="Actual_Return_Time" value="{{ substr($book->Actual_Return_Date, 11) }}" />
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
                            <input type="text" class="form-control" id="txtNotes" name="Booking_Notes" value="{{ $book->Booking_Notes }}" />
                        </div>
                        <div class="form-group">
                            <label for="txtPayNo">Payment No.</label>
                            <select class="form-control" id="txtPayNo" name="Payment_No">
                                @foreach ($pays as $p)
                                    <option value="{{ $p->Payment_No }}"
                                        @if ($book->Payment_No == $p->Payment_No)
                                            selected
                                        @endif
                                    >{{ $p->Payment_No.' - $'.$p->Payment_Amount.' ('.$p->Card_Name.')' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="txtStaffNo">Staff No.</label>
                            <select class="form-control" id="txtStaffNo" name="Staff_No">
                                @foreach ($staff as $s)
                                    <option value="{{ $s->Staff_No }}"
                                        @if ($book->Staff_No == $s->Staff_No)
                                            selected
                                        @endif
                                    >{{ $s->Staff_No.' - '.$s->First_Name.' '.$s->Last_Name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input class="carshare-btn" type="submit" value="Update Booking" />
                        <a href="{{ url('bookings') }}"><input type="button" class="carshare-btn" value="Cancel" /></a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var min = moment();
        var start = '{{ $book->Start_Date }}';
        var finish = '{{ $book->Return_Date }}';
        $("#dtPicky1").datetimepicker({format: "YYYY-MM-DD", useCurrent: false, defaultDate: start});
        $("#dtPicky2").datetimepicker({format: "HH:mm", useCurrent: false, defaultDate: start});
        $("#dtPicky3").datetimepicker({format: "YYYY-MM-DD", useCurrent: false, defaultDate: finish});
        $("#dtPicky4").datetimepicker({format: "HH:mm", useCurrent: false, defaultDate: finish});
    </script>

@endsection
