@extends('layouts.layout_home')

@section('content')

@if (count($mems) > 0)

    <table class="table">

        <tr class="carshare-table-hdr">
            <th>Name</th>
            <th>Address</th>
            <th>Phone No.</th>
            <th>Email Address</th>
            <th>License No.</th>
            <th>Acceptance Date</th>
        </tr>

        @foreach ($mems as $m)

            <tr class="carshare-table-row">
                <td>{{ $m->First_Name.' '.$m->Last_Name }}</td>
                <td>{{ $m->Street_Address.', '.$m->Suburb.', '.$m->Postcode }}</td>
                <td>{{ $m->Phone_No }}</td>
                <td>{{ $m->Email_Add }}</td>
                <td>{{ $m->Licence_No }}</td>
                <td>{{ substr($m->Acceptance_Date, 0, 10) }}</td>
            </tr>

        @endforeach

    </table>
	
@else

    <div class="container">
        <div class="panel">
            <div class="panel-body">
                {{ $def }}
            </div>
        </div>
    </div>

@endif

@isset($errs)

	<div class="container">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading carshare-subheader-bad">Some archive operations failed</div>
				<div class="panel-body carshare-bad">
					<p>{{ $errs }} members could not be archived, since they have un-archived bookings</p>
				</div>
			</div>
		</div>
	</div>

@endisset

@endsection
