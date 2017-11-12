@extends('layouts.layout_home')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading carshare-subheader">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="position" class="col-md-4 control-label">Position</label>

                            <div class="col-md-6">
                                <select id="position" class="form-control" name="position">
                                    <option value="Staff" {{ old('position') === 'Staff' || old('position') === null ? 'selected' : '' }}>Staff</option>
                                    <option value="Admin" {{ old('position') === 'Admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="Senior Admin" {{ old('position') === 'Senior Admin' ? 'selected' : '' }}>Senior Admin</option>
                                    <option value="Manager" {{ old('position') === 'Manager' ? 'selected' : '' }}>Manager</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('first') ? ' has-error' : '' }}">
                            <label for="first" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="first" type="text" class="form-control" name="first" value="{{ old('first') }}" required>

                                @if ($errors->has('first'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last') ? ' has-error' : '' }}">
                            <label for="last" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="last" type="text" class="form-control" name="last" value="{{ old('last') }}" required>

                                @if ($errors->has('last'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
                            <label for="street" class="col-md-4 control-label">Street Address</label>

                            <div class="col-md-6">
                                <input id="street" type="text" class="form-control" name="street" value="{{ old('street') }}" required>

                                @if ($errors->has('street'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('street') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('suburb') ? ' has-error' : '' }}">
                            <label for="suburb" class="col-md-4 control-label">Suburb</label>

                            <div class="col-md-6">
                                <input id="suburb" type="text" class="form-control" name="suburb" value="{{ old('suburb') }}" required>

                                @if ($errors->has('suburb'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('suburb') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('postCode') ? ' has-error' : '' }}">
                            <label for="postCode" class="col-md-4 control-label">Post Code</label>

                            <div class="col-md-6">
                                <input id="postCode" type="text" class="form-control" name="postCode" value="{{ old('postCode') }}" required>

                                @if ($errors->has('postCode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('postCode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone Number</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}">

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Email_Add') ? ' has-error' : '' }}">
                            <label for="Email_Add" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="Email_Add" type="email" class="form-control" name="Email_Add" value="{{ old('Email_Add') }}" required>

                                @if ($errors->has('Email_Add'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Email_Add') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dtPicky" class="col-md-4 control-label">Date of Birth</label>
                            <div class="col-md-6">
                                <div class="input-group date" id="dtPicky">
                                    <input type="text" class="form-control" id="dob" name="dob" required>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var max = moment();
    var def = moment("1975-01-01");
    $("#dtPicky").datetimepicker({format: "YYYY-MM-DD", maxDate: max, defaultDate: def, useCurrent: false, widgetPositioning: {horizontal: 'right'}});
</script>

@endsection
