@extends('layouts.layout_home')

@section('content')

@if (count($locs) > 0)

    <table class="table">

        <tr class="carshare-table-hdr">
            <th>Location ID</th>
            <th>Council</th>
            <th>Address</th>
            <th>Parking Levy</th>
            <th></th>
        </tr>

        @foreach ($locs as $l)

            <tr class="carshare-table-row">
                <td>{{ $l['id'] }}</td>
                <td>{{ $l['council'] }}</td>
                <td>{{ $l['address'].', '.$l['suburb'].', '.$l['postCode'] }}</td>
                <td>{{ $l['parkingLevy'] }}</td>
                <td><form method="get" action="{{ url('locations/show/'.$l['id']) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Details" /></form></td>
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

	<form method="get" action="{{ url('locations/new') }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="New Location" /></form>

@endsection
