@extends('layouts.layout_home')

@section('content')

	<a href="{{ url('vehicles') }}"><input type="button" class="carshare-btn" value="Return to Vehicles" /></a>
	<p></p>

    <table class="table">

        <tr class="carshare-table-hdr">
            <th>Registration Number</th>
            <th>VIN</th>
            <th>Model</th>
            <th>Colour</th>
            <th>Odometer (km)</th>
            <th>Year</th>
            <th>Location</th>
            <th>Date of Acquisition</th>
            <th>Date of Disposal</th>
            <th>Staff No.</th>
        </tr>

		<tr class="carshare-table-row">
			<td>{{ $vehix->Rego_No }}</td>
			<td>{{ $vehix->VIN_No }}</td>
			<td>{{ $vehix->Make.' '.$vehix->Model }}</td>
			<td>{{ $vehix->Colour }}</td>
			<td>{{ $vehix->Odo_Reading }}</td>
			<td>{{ $vehix->Year }}</td>
			<td>{{ $vehix->Street_Address }}</td>
			<td>{{ substr($vehix->Date_Acquired, 0, 10) }}</td>
			<td>{{ substr($vehix->Date_Disposed, 0, 10) }}</td>
			<td>{{ $vehix->Staff_No }}</td>
		</tr>

    </table>
	
	<ul class="list-inline">
		<li><form method="get" action="{{ url('vehicles/update/'.$vehix->Rego_No) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Update" /></form></li>
		<li><form method="get" action="{{ url('vehicles/retire/'.$vehix->Rego_No) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Retire" /></form></li>
		<li><form method="post" action="{{ url('vehicles/delete/'.$vehix->Rego_No) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Delete" /></form></li>
	</ul>
	
@if (count($reports) > 0)

<div class="container">
	<div class="panel">
		<div class="panel-heading carshare-subheader">Damage Reports for this Vehicle</div>
		<div class="panel-body">
			<table class="table">

				<tr class="carshare-table-hdr">
					<th>Damage Report ID</th>
					<th>Member</th>
					<th>Date</th>
					<th>Time</th>
					<th>Description</th>
				</tr>

				@foreach ($reports as $r)

					<tr class="carshare-table-row">
						<td>{{ $r->Damage_Id }}</td>
						<td>{{ $r->Membership_No.' ('.$r->First_Name.' '.$r->Last_Name.')' }}</td>
						<td>{{ substr($r->Damage_Date, 0, 10) }}</td>
						<td>{{ substr($r->Damage_Date, 11) }}</td>
						<td>{{ $r->Feedback }}</td>
					</tr>

				@endforeach

			</table>
		</div>
	</div>
</div>

@else

    <div class="container">
        <div class="panel">
            <div class="panel-body">
                {{ $defNoReports }}
            </div>
        </div>
    </div>

@endif

@if (count($reviews) > 0)

<div class="container">
	<div class="panel">
		<div class="panel-heading carshare-subheader">Reviews for this Vehicle</div>
		<div class="panel-body">
			<table class="table">

				<tr class="carshare-table-hdr">
					<th>Review ID</th>
					<th>Member</th>
					<th>Date</th>
					<th>Time</th>
					<th>Rating</th>
					<th>Review</th>
				</tr>

				@foreach ($reviews as $r)

					<tr class="carshare-table-row">
						<td>{{ $r->Review_Id }}</td>
						<td>{{ $r->Membership_No.' ('.$r->First_Name.' '.$r->Last_Name.')' }}</td>
						<td>{{ substr($r->Review_Date, 0, 10) }}</td>
						<td>{{ substr($r->Review_Date, 11) }}</td>
						<td>{{ $r->Rating }}</td>
						<td>{{ $r->Feedback }}</td>
					</tr>

				@endforeach

			</table>
		</div>
	</div>
</div>

@else

    <div class="container">
        <div class="panel">
            <div class="panel-body">
                {{ $defNoReviews }}
            </div>
        </div>
    </div>

@endif

@if (count($books) > 0)

<div class="container">
	<div class="panel">
		<div class="panel-heading carshare-subheader">Uncompleted Bookings for this Vehicle</div>
		<div class="panel-body">
			<table class="table">

				<tr class="carshare-table-hdr">
					<th>Booking No.</th>
					<th>Booking Date</th>
					<th>Member</th>
					<th>Start Time</th>
					<th>Due Return Time</th>
				</tr>

				@foreach ($books as $b)

					<tr class="carshare-table-row">
						<td>{{ $b->Booking_No }}</td>
						<td>{{ $b->Booking_Date }}</td>
						<td>{{ $b->Membership_No.' ('.$b->First_Name.' '.$b->Last_Name.')' }}</td>
						<td>{{ $b->Start_Date }}</td>
						<td>{{ $b->Return_Date }}</td>
					</tr>

				@endforeach

			</table>
		</div>
	</div>
</div>

@else

    <div class="container">
        <div class="panel">
            <div class="panel-body">
                {{ $defNoReviews }}
            </div>
        </div>
    </div>

@endif

@endsection
