@extends('layouts.layout_home')

@section('content')

@if (count($mems) > 0)

    <table class="table">

        <tr class="carshare-table-hdr">
            <th>Member ID</th>
            <th>Membership Type</th>
            <th>Membership Status</th>
            <th>Name</th>
            <th>Phone No.</th>
            <th>Email Address</th>
            <th>License Expiry Date</th>
            <th></th>
        </tr>

        @foreach ($mems as $m)

            <tr class="carshare-table-row">
                <td>{{ $m->Membership_No }}</td>
                <td>{{ $m->MemType_Id.' ('.$m->Type_Name.')' }}</td>
                <td>{{ $m->Status }}</td>
                <td>{{ $m->First_Name.' '.$m->Last_Name }}</td>
                <td>{{ $m->Phone_No }}</td>
                <td>{{ $m->Email_Add }}</td>
                <td>{{ $m->Licence_Exp }}</td>
                <td><form method="get" action="{{ url('members/show/'.$m->Membership_No.'/'.$m->MemType_Id) }}">{{ csrf_field() }}<input type="submit" class="carshare-btn" value="Details" /></form></td>
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
