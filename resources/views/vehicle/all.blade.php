@extends('layouts.layout_home')

@section('content')

@if (count($vehix) > 0)

    <table class="table">

        <tr class="carshare-table-hdr">
            <th>Registration Number</th>
            <th>Odometer (km)</th>
            <th>Location</th>
            <th>Date of Disposal</th>
            <th></th>
        </tr>

        @foreach ($vehix as $v)

            <tr class="carshare-table-row">
                <td>{{ $v->Rego_No }}</td>
                <td>{{ $v->Odo_Reading }}</td>
                <td>{{ $v->Street_Address.', '.$v->Suburb }}</td>
                <td>{{ substr($v->Date_Disposed, 0, 10) }}</td>
                <td><form method="get" action="{{ url('vehicles/show/'.$v->Rego_No) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Details" /></form></td>
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
