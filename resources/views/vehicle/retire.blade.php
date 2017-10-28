@extends('layouts.layout_home')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Retire Vehicle</div>
                <div class="panel-body">
                    Are you sure you want to retire vehicle {{ $rego }}?
                </div>
                <div class="panel-body">
                    <form action="{{ url('vehicles/retire/'.$rego) }}" method="post">
                        {{ csrf_field() }}
                        <input type="submit" class="carshare-btn" value="Retire" />
                        <a href="{{ url('vehicles/show/'.$rego) }}"><input type="button" class="carshare-btn" value="Cancel" /></a>
                    </form>
                </div>
                <div class="panel-body">
                </div>
            </div>
        </div>
    </div>
@endsection
