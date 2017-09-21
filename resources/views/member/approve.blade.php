@extends('layouts.layout_home')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Approval</div>
                <div class="panel-body">
                    Approve Member ID {{ $id }}?
                </div>
                <div class="panel-body">
                    <a href="{{ url('members/') }}"><button class="carshare-btn">Approve</button></a>
					<a href="{{ url('members/show/'.$id) }}"><button class="carshare-btn">Cancel</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection