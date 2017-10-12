@extends('layouts.layout_home')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Outcome</div>
                <div class="panel-body">
                    {{ $msg }}
                </div>
                <div class="panel-body">
                    <a href="{{ url('members/') }}"><button class="carshare-btn">Return to Members</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection
