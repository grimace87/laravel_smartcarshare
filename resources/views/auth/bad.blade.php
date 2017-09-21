@extends('layouts.layout_home')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Inadequate Authority</div>
                <div class="panel-body">
                    You are not authorised to do that.
                </div>
                <div class="panel-body">
                    <a href="{{ url()->previous() }}"><input type="button" class="carshare-btn" value="Back" /></a>
                </div>
                <div class="panel-body">
                </div>
            </div>
        </div>
    </div>
@endsection
