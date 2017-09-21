@extends('layouts.layout_home')

@section('content')

	<a href="{{ url('members') }}"><input type="button" class="carshare-btn" value="Return to Members" /></a>
	<p></p>

    <table class="table">

        <tr class="carshare-table-hdr">
            <th>Member Number</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone No.</th>
            <th>Email Address</th>
            <th>License No.</th>
            <th>License Expiry Date</th>
        </tr>

		<tr class="carshare-table-row">
			<td>{{ $mem['memNo'] }}</td>
			<td>{{ $mem['firstName'].' '.$mem['lastName'] }}</td>
			<td>{{ $mem['address'].', '.$mem['suburb'].', '.$mem['postCode'] }}</td>
			<td>{{ $mem['phone'] }}</td>
			<td>{{ $mem['email'] }}</td>
			<td>{{ $mem['licenseNo'] }}</td>
			<td>{{ substr($mem['licenseExp'], 0, 10) }}</td>
		</tr>

    </table>

	<ul class="list-inline">
		<li><form method="post" action="{{ url('members/approve/'.$mem['memNo']) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Approve" /></form></li>
		<li><form method="post" action="{{ url('members/renew/'.$mem['memNo']) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Renew" /></form></li>
		<li><form method="get" action="{{ url('members/update/'.$mem['memNo']) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Update" /></form></li>
		<li><form method="post" action="{{ url('members/cancel/'.$mem['memNo']) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Cancel" /></form></li>
		<li><form method="post" action="{{ url('members/delete/'.$mem['memNo']) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Delete" /></form></li>
	</ul>
	
@endsection
