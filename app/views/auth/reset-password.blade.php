@extends('layouts.default')

@section('title')
Reset your password
@stop

@section('styles')
@parent
#panel-reset-password {
	width: 400px;
	margin: 160px auto;
}
@stop

@section('content')

<div class="container">

	<div class="panel panel-default" id="panel-reset-password">
		
		<div class="panel-heading">
			<h3 class="panel-title">Reset your password</h3>
		</div>

		<div class="panel-body">
			
			@if (Session::has('error'))
				{{ trans(Session::get('reason')) }}
			@endif

			{{ Form::open(array('action' => 'AuthController@postResetPassword', 'role' => 'form')) }}
				
				{{ Form::hidden('token', $token) }}

				<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
					<label for="inputEmail" class="control-label">Email address</label>
					<input type="email" id="inputEmail" name="email" class="form-control" value="{{ Input::old('email') }}">
					{{ $errors->first('email', '<span class="help-block">:message</span>') }}
				</div>

				<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
					<label for="inputPassword" class="control-label">Password</label>
					<input type="password" id="inputPassword" name="password" class="form-control">
					{{ $errors->first('password', '<span class="help-block">:message</span>') }}
				</div>

				<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
					<label for="inputPasswordConfirmation" class="control-label">Confirm Password</label>
					<input type="password" id="inputPasswordConfirmation" name="password_confirmation" class="form-control">
					{{ $errors->first('password_confirmation', '<span class="help-block">:message</span>') }}
				</div>

				<button type="submit" class="btn btn-primary btn-lg btn-block">Save password</button>

			{{ Form::close() }}

		</div>

	</div>

</div>

@stop