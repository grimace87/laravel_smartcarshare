@extends('layouts.layout_home')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Cancellation</div>
                <div class="panel-body">
                    Cancel Member ID {{ $id }} on membership type {{ $memType }}?
                </div>
                <div class="panel-body">
                    <form method="post" action="{{ url('members/cancel/confirmed/'.$id.'/'.$memType) }}">
                        {{ csrf_field() }}
                        <input type="submit" class="carshare-btn" value="Cancel Member" />
                        <a href="{{ url('members/show/'.$id.'/'.$memType) }}"><input type="button" class="carshare-btn" value="Don't Cancel" /></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
