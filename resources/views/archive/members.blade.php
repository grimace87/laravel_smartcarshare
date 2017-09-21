@extends('layouts.layout_home')

@section('content')

@if (count($mems) > 0)

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

        @foreach ($mems as $m)

            <tr class="carshare-table-row">
                <td>{{ $m['memNo'] }}</td>
                <td>{{ $m['firstName'].' '.$m['lastName'] }}</td>
                <td>{{ $m['address'].', '.$m['suburb'].', '.$m['postCode'] }}</td>
                <td>{{ $m['phone'] }}</td>
                <td>{{ $m['email'] }}</td>
                <td>{{ $m['licenseNo'] }}</td>
                <td>{{ substr($m['licenseExp'], 0, 10) }}</td>
            </tr>

        @endforeach

    </table>
	
	<form method="post" action="{{ url('archive/members') }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Archive All" /></form>
	
@else

    <div class="container">
        <div class="panel">
            <div class="panel-body">
                {{ $def }}
            </div>
        </div>
    </div>

@endif

@endsection
