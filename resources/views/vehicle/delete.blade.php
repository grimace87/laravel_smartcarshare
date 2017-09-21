@extends('layouts.layout_home')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Delete Vehicle</div>
				<div class="panel-body">
                    Are you sure you want to delete vehicle {{ $id }}?
				</div>
                <div class="panel-body">
                    <form action="{{ url('vehicles/delete/'.$id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="id" value="{{ $id }}" />
                        <input type="submit" class="carshare-btn" value="Delete" />
                        <a href="{{ url('vehicles/show/'.$id) }}"><input type="button" class="carshare-btn" value="Cancel" /></a>
                    </form>
                </div>
                <div class="panel-body">
                </div>
            </div>
        </div>
    </div>
@endsection
