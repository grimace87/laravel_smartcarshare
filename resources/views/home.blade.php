@extends('layouts.layout_home')

@section('content')
<div class="container">

    <!-- Members -->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Members</div>
                <div class="panel-body">
                    <ul class="carshare-indent-list">
                        <li><a href="{{ url('/members') }}">View All</a></li>
                        <li><a href="{{ url('/members/approvals') }}">Approvals</a></li>
                        <li><a href="{{ url('/members/renewals') }}">Renewals</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Bookings -->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Bookings</div>
                <div class="panel-body">
                    <ul class="carshare-indent-list">
                        <li><a href="{{ url('/bookings') }}">View All</a></li>
                        <li><a href="{{ url('/bookings/new') }}">New Booking</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Vehicles -->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Vehicles</div>
                <div class="panel-body">
                    <ul class="carshare-indent-list">
                        <li><a href="{{ url('/vehicles') }}">View All</a></li>
                        <li><a href="{{ url('/vehicles/new') }}">New Vehicle</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Locations -->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Locations</div>
                <div class="panel-body">
                    <ul class="carshare-indent-list">
                        <li><a href="{{ url('/locations') }}">View All</a></li>
                        <li><a href="{{ url('/locations/new') }}">New Location</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Staff -->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Staff</div>
                <div class="panel-body">
                    <ul class="carshare-indent-list">
                        <li><a href="{{ url('/staff') }}">View All</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Archive -->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Archive</div>
                <div class="panel-body">
                    <ul class="carshare-indent-list">
                        <li><a href="{{ url('/archive/members') }}">Archive Members</a></li>
                        <li><a href="{{ url('/archive/bookings') }}">Archive Bookings</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
