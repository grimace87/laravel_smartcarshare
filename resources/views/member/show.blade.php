@extends('layouts.layout_home')

@section('content')

	<a href="{{ url('members') }}"><input type="button" class="carshare-btn" value="Return to Members" /></a>
	<p></p>

    <table class="table">

        <tr class="carshare-table-hdr">
            <th>Member Number</th>
			<th>Membership Type</th>
			<th>Status</th>
			<th>Name</th>
            <th>Address</th>
            <th>Phone No.</th>
            <th>Email Address</th>
            <th>License No.</th>
            <th>License Expiry Date</th>
        </tr>

		<tr class="carshare-table-row">
			<td>{{ $mem->Membership_No }}</td>
			<td>{{ $mem->MemType_Id.' ('.$mem->Type_Name.')' }}</td>
			<td>{{ $mem->Status }}</td>
			<td>{{ $mem->First_Name.' '.$mem->Last_Name }}</td>
			<td>{{ $mem->Street_Address.', '.$mem->Suburb.', '.$mem->Postcode }}</td>
			<td>{{ $mem->Phone_No }}</td>
			<td>{{ $mem->Email_Add }}</td>
			<td>{{ $mem->Licence_No }}</td>
			<td>{{ $mem->Licence_Exp }}</td>
		</tr>

    </table>

	<ul class="list-inline">
		<li><form method="post" action="{{ url('members/approve/'.$mem->Membership_No.'/'.$mem->MemType_Id) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Approve" /></form></li>
		<li><form method="post" action="{{ url('members/renew/'.$mem->Membership_No.'/'.$mem->MemType_Id) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Renew" /></form></li>
		<li><form method="post" action="{{ url('members/cancel/'.$mem->Membership_No.'/'.$mem->MemType_Id) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Cancel" /></form></li>
		<li><form method="get" action="{{ url('members/update/'.$mem->Membership_No.'/'.$mem->MemType_Id) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Update" /></form></li>
		<li><form method="post" action="{{ url('members/delete/'.$mem->Membership_No.'/'.$mem->MemType_Id) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Delete" /></form></li>
	</ul>
	
@endsection
