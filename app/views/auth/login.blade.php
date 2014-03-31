@extends('layouts.default')

@section('title')
Login - 
@parent
@stop

@section('styles')
@parent
#panel-login {
	width: 400px;
	margin: 160px auto;
}
@stop

@section('content')

<div class="container">

	<div class="panel panel-default" id="panel-login">

		<div class="panel-heading">
			<h3 class="panel-title">Login</h3>
		</div>

		<div class="panel-body">

			@if(Auth::check())

				<p><strong>Stop!</strong> You are already logged in as:<br><br><strong>{{ Auth::user()->email }}</strong>.<br><br>Would you like to <a href="{{ URL::route('auth-logout') }}">discontinue your current session</a> and log in as a different user, or return to the <a href="{{ URL::route('home-index') }}">home page</a>?</p>

			@else

				@if ($just_registered)
					<p style="margin-top:20px; margin-bottom: 20px;">Thank you for registering. Email verification is now required to continue. Please check your email and follow the link provided.</p>
				@endif

				{{ Form::open(array('action' => 'AuthController@store', 'role' => 'form')) }}
					
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

					<div class="checkbox">
						<label>
							<input type="checkbox" name="remember" value="1" {{ (Input::old('remember')) ? 'checked' : '' }}> Remember me
						</label>
					</div>

					<button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>

				{{ Form::close() }}

			@endif

		</div>

		<div class="panel-footer">
			<a class="pull-left" href="{{ URL::route('auth-forgot-password')}}">Forgot Password?</a>
			<a class="pull-right" href="{{ URL::route('user-register')}}">Register</a>
			<br>
		</div>

	</div>

</div>

@stop