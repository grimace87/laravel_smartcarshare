@extends('layouts.layout_home')

@section('content')

@if (count($vehix) > 0)

    <table class="table">

        <tr class="carshare-table-hdr">
            <th>Registration Number</th>
            <th>Odometer (km)</th>
            <th>Transmission</th>
            <th>Location</th>
            <th>Date of Disposal</th>
            <th></th>
        </tr>

        @foreach ($vehix as $v)

            <tr class="carshare-table-row">
                <td>{{ $v['rego'] }}</td>
                <td>{{ $v['odometer'] }}</td>
                <td>{{ $v['trans'] }}</td>
                <td>{{ $v['locID'] }}</td>
                <td>{{ substr($v['disposalDateTime'], 0, 10) }}</td>
                <td><form method="get" action="{{ url('vehicles/show/'.$v['rego']) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Details" /></form></td>
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

	<form method="get" action="{{ url('vehicles/new') }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="New Vehicle" /></form>

@endsection
