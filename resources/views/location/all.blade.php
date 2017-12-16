@extends('layouts.layout_home')

@section('content')

@if (count($locs) > 0)

	<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body" style="padding: 0px;">

					<table class="table">

						<tr class="carshare-table-hdr">
							<th>Location ID <br> <a href="{{ url('locations/filter/1') }}">ᐱ</a> &nbsp; &nbsp; <a href="{{ url('locations/filter/2') }}">ᐯ</a></th>
							<th>Council <br> <a href="{{ url('locations/filter/3') }}">ᐱ</a> &nbsp; &nbsp; <a href="{{ url('locations/filter/4') }}">ᐯ</a></th>
							<th>Address</th>
							<th>Parking Levy</th>
							<th></th>
						</tr>

						@foreach ($locs as $l)

							<tr class="carshare-table-row">
								<td>{{ $l->Location_Id }}</td>
								<td>{{ $l->Council_Name }}</td>
								<td>{{ $l->Street_Address.', '.$l->Suburb.', '.$l->Postcode }}</td>
								<td>{{ $l->Parking_Levy_Amt }}</td>
								<td><form method="get" action="{{ url('locations/show/'.$l->Location_Id) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Details" /></form></td>
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

					<form method="get" action="{{ url('locations/new') }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="New Location" /></form>
				</div>
			</div>
		</div>
    </div>
@endsection
