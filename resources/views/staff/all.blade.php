@extends('layouts.layout_home')

@section('content')

@if (count($staff) > 0)

	<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body" style="padding: 0px;">

					<table class="table">

						<tr class="carshare-table-hdr">
							<th>Staff ID <br> <a href="{{ url('staff/filter/1') }}">ᐱ</a> &nbsp; &nbsp; <a href="{{ url('staff/filter/2') }}">ᐯ</a></th>
							<th>Name <br> <a href="{{ url('staff/filter/3') }}">ᐱ</a> &nbsp; &nbsp; <a href="{{ url('staff/filter/4') }}">ᐯ</a></th>
							<th>Email Address</th>
							<th>Position <br> <a href="{{ url('staff/filter/5') }}">ᐱ</a> &nbsp; &nbsp; <a href="{{ url('staff/filter/6') }}">ᐯ</a></th>
							<th></th>
						</tr>

						@foreach ($staff as $s)

							<tr class="carshare-table-row">
								<td>{{ $s->Staff_No }}</td>
								<td>{{ $s->First_Name.' '.$s->Last_Name }}</td>
								<td>{{ $s->Email_Add }}</td>
								<td>{{ $s->Position }}</td>
								<td>
								@if (Auth::user()->Staff_No == $s->Staff_No || Auth::user()->Position == 'Manager' || Auth::user()->Position == 'Senior Admin')
									<form method="get" action="{{ url('staff/show/'.$s->Staff_No) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Details" /></form>
								@endif
								</td>
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
