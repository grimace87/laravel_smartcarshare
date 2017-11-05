@extends('layouts.layout_home')

@section('content')

@if (count($books) > 0)

    <table class="table">

        <tr class="carshare-table-hdr">
            <th>Booking No. &nbsp; &nbsp; <a href="{{ url('bookings/filter/1') }}">ᐱ</a> &nbsp; &nbsp; <a href="{{ url('bookings/filter/2') }}">ᐯ</a></th>
            <th>Registration No. &nbsp; &nbsp; <a href="{{ url('bookings/filter/3') }}">ᐱ</a> &nbsp; &nbsp; <a href="{{ url('bookings/filter/4') }}">ᐯ</a></th>
            <th>Membership &nbsp; &nbsp; <a href="{{ url('bookings/filter/5') }}">ᐱ</a> &nbsp; &nbsp; <a href="{{ url('bookings/filter/6') }}">ᐯ</a></th>
            <th>Booking Time</th>
            <th>Start Date</th>
            <th>Finish Date</th>
            <th>Total (GST excl.)</th>
            <th>Notes</th>
            <th>Payment ID</th>
            <th></th>
        </tr>

        @foreach ($books as $b)

            <tr class="carshare-table-row">
                <td>{{ $b->Booking_No }}</td>
                <td>{{ $b->Rego_No }}</td>
                <td>{{ $b->Membership_No }}</td>
                <td>{{ $b->Booking_Date }}</td>
                <td>{{ substr($b->Start_Date, 0, 10) }}</td>
                <td>{{ substr($b->Return_Date, 0, 10) }}</td>
                <td>{{ $b->Total_exGST }}</td>
                <td>{{ $b->Booking_Notes }}</td>
                <td>{{ $b->Payment_No }}</td>
                <td><form method="get" action="{{ url('bookings/show/'.$b->Booking_No) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Details" /></form></td>
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

	<form method="get" action="{{ url('bookings/new') }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="New Booking" /></form>

@endsection
