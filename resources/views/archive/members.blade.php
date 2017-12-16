@extends('layouts.layout_home')

@section('content')

@if (count($mems) > 0)

	<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body" style="padding: 0px;">

					<table class="table">

						<tr class="carshare-table-hdr">
							<th>Name <br> <a href="{{ url('archive/members/filter/1') }}">ᐱ</a> &nbsp; &nbsp; <a href="{{ url('archive/members/filter/2') }}">ᐯ</a></th>
							<th>Status <br> <a href="{{ url('archive/members/filter/3') }}">ᐱ</a> &nbsp; &nbsp; <a href="{{ url('archive/members/filter/4') }}">ᐯ</a></th>
							<th>Email Address</th>
							<th>License No.</th>
							<th>Acceptance Date</th>
						</tr>

						@foreach ($mems as $m)

							<tr class="carshare-table-row">
								<td>{{ $m->First_Name.' '.$m->Last_Name }}</td>
								<td>{{ $m->Status }}</td>
								<td>{{ $m->Email_Add }}</td>
								<td>{{ $m->Licence_No }}</td>
								<td>{{ substr($m->Acceptance_Date, 0, 10) }}</td>
							</tr>

						@endforeach

					</table>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading carshare-subheader">Selection for Archive</div>
				<div class="panel-body">
						
					<p>Please note that any reviews or damage reports recorded by the
					archived members will be lost.</p>
						
					<p>This operation cannot be reversed.</p>
				</div>
				<div class="panel-footer">
					<form method="post" action="{{ url('archive/members') }}">
						{{ csrf_field() }}
							
						<label for="">Archive Filter</label>
						<select class="form-control" id="Selection_Mode" name="Selection_Mode">
							<option value="NoCurrent" selected>Memberships Expired or Cancelled</option>
							<option value="CancelledOrSuspended">Memberships Expired, Cancelled of Suspended</option>
						</select>
						<br>
						<input type="submit" class="carshare-btn" value="Archive Members" />
					</form>
				</div>
			</div>
		</div>
	</div>
	
@else

    <div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-body">
					{{ $def }}
				</div>
            </div>
        </div>
    </div>

@endif

@endsection
