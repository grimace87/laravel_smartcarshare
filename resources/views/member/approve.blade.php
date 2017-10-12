@extends('layouts.layout_home')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Approval</div>
                <div class="panel-body">
                    Approve Member ID {{ $id }} on membership type {{ $memType }}?
                </div>
                <div class="panel-body">
                    <form method="post" action="{{ url('members/approve/confirmed/'.$id.'/'.$memType) }}">
                        {{ csrf_field() }}
                        <input type="submit" class="carshare-btn" value="Approve Member" />
                        <a href="{{ url('members/show/'.$id.'/'.$memType) }}"><input type="button" class="carshare-btn" value="Cancel" /></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
