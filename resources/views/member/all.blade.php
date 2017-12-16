@extends('layouts.layout_home')

@section('content')

@if (count($mems) > 0)

	<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body" style="padding: 0px;">

					<table class="table">

						<tr class="carshare-table-hdr">
							<th>Member ID <br> <a href="{{ url('members/filter/1') }}">ᐱ</a> &nbsp; &nbsp; <a href="{{ url('members/filter/2') }}">ᐯ</a></th>
							<th>Membership Type</th>
							<th>Membership Status <br> <a href="{{ url('members/filter/3') }}">ᐱ</a> &nbsp; &nbsp; <a href="{{ url('members/filter/4') }}">ᐯ</a></th>
							<th>Name <br> <a href="{{ url('members/filter/5') }}">ᐱ</a> &nbsp; &nbsp; <a href="{{ url('members/filter/6') }}">ᐯ</a></th>
							<th>Email Address</th>
							<th></th>
						</tr>

						@foreach ($mems as $m)

							<tr class="carshare-table-row">
								<td>{{ $m->Membership_No }}</td>
								<td>{{ $m->MemType_Id.' ('.$m->Type_Name.')' }}</td>
								<td>{{ $m->Status }}</td>
								<td>{{ $m->First_Name.' '.$m->Last_Name }}</td>
								<td>{{ $m->Email_Add }}</td>
								<td><form method="get" action="{{ url('members/show/'.$m->Membership_No.'/'.$m->MemType_Id) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Details" /></form></td>
							</tr>

						@endforeach

					</table>

				</div>
			</div>
		</div>
	</div>

@else

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body" style="padding: 0px;">
					{{ $def }}
				</div>
			</div>
		</div>
    </div>

@endif

@endsection
