@extends('layouts.layout_home')

@section('content')

@if (count($staff) > 0)

    <table class="table">

        <tr class="carshare-table-hdr">
            <th>Staff ID</th>
            <th>Name</th>
            <th>Email Address</th>
            <th>Position</th>
            <th></th>
        </tr>

        @foreach ($staff as $s)

            <tr class="carshare-table-row">
                <td>{{ $s['staffNo'] }}</td>
                <td>{{ $s['firstName'].' '.$s['lastName'] }}</td>
                <td>{{ $s['email'] }}</td>
                <td>{{ $s['position'] }}</td>
                <td><form method="get" action="{{ url('staff/show/'.$s['staffNo']) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Details" /></form></td>
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
