@extends('layouts.layout_home')

@section('content')

@if (count($mems) > 0)

    <table class="table">

        <tr class="carshare-table-hdr">
            <th>Member Number</th>
            <th>Name</th>
            <th>Phone No.</th>
            <th>Email Address</th>
            <th>License Expiry Date</th>
            <th></th>
        </tr>

        @foreach ($mems as $m)

            <tr class="carshare-table-row">
                <td>{{ $m['memNo'] }}</td>
                <td>{{ $m['firstName'].' '.$m['lastName'] }}</td>
                <td>{{ $m['phone'] }}</td>
                <td>{{ $m['email'] }}</td>
                <td>{{ substr($m['licenseExp'], 0, 10) }}</td>
                <td><form method="get" action="{{ url('members/show/'.$m['memNo']) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Details" /></form></td>
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

@endsection
