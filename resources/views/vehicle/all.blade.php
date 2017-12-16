@extends('layouts.layout_home')

@section('content')

@if (count($vehix) > 0)

	<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body" style="padding: 0px;">

					<table class="table">

						<tr class="carshare-table-hdr">
							<th>Registration Number <br> <a href="{{ url('vehicles/filter/1') }}">ᐱ</a> &nbsp; &nbsp; <a href="{{ url('vehicles/filter/2') }}">ᐯ</a></th>
							<th>Model</th>
							<th>Odometer (km) <br> <a href="{{ url('vehicles/filter/3') }}">ᐱ</a> &nbsp; &nbsp; <a href="{{ url('vehicles/filter/4') }}">ᐯ</a></th>
							<th>Location</th>
							<th>Date of Disposal</th>
							<th></th>
						</tr>

						@foreach ($vehix as $v)

							<tr class="carshare-table-row">
								<td>{{ $v->Rego_No }}</td>
								<td>{{ $v->Make.' '.$v->Model }}</td>
								<td>{{ $v->Odo_Reading }}</td>
								<td>{{ $v->Street_Address.', '.$v->Suburb }}</td>
								<td>{{ substr($v->Date_Disposed, 0, 10) }}</td>
								<td><form method="get" action="{{ url('vehicles/show/'.$v->Rego_No) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Details" /></form></td>
							</tr>

						@endforeach

					</table>
				</div>
				<div class="panel-footer">
	
@else

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body" style="padding: 0px;">
					{{ $def }}
				</div>
				<div class="panel-footer">
				
@endif

					<form method="get" action="{{ url('vehicles/new') }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="New Vehicle" /></form>
				</div>
			</div>
		</div>
	</div>

@endsection
