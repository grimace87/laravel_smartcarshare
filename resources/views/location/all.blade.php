@extends('layouts.layout_home')

@section('content')

@if (count($locs) > 0)

    <table class="table">

        <tr class="carshare-table-hdr">
            <th>Location ID &nbsp; &nbsp; <a href="{{ url('locations/filter/1') }}">ᐱ</a> &nbsp; &nbsp; <a href="{{ url('locations/filter/2') }}">ᐯ</a></th>
            <th>Council &nbsp; &nbsp; <a href="{{ url('locations/filter/3') }}">ᐱ</a> &nbsp; &nbsp; <a href="{{ url('locations/filter/4') }}">ᐯ</a></th>
            <th>Address</th>
            <th>Parking Levy</th>
            <th></th>
        </tr>

        @foreach ($locs as $l)

            <tr class="carshare-table-row">
                <td>{{ $l->Location_Id }}</td>
                <td>{{ $l->Council_Name }}</td>
                <td>{{ $l->Street_Address.', '.$l->Suburb.', '.$l->Postcode }}</td>
                <td>{{ $l->Parking_Levy_Amt }}</td>
                <td><form method="get" action="{{ url('locations/show/'.$l->Location_Id) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Details" /></form></td>
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
