@extends('layouts.default')

@section('title')
Forgot your password? - 
@parent
@stop

@section('styles')
@parent
#panel-remind {
	width: 400px;
	margin: 160px auto;
}
@stop

@section('content')

<div class="container">

	<div class="panel panel-default" id="panel-remind">
		
		<div class="panel-heading">
			<h3 class="panel-title">Forgot your password?</h3>
		</div>

		<div class="panel-body">
			
			@if (Session::has('error'))
				{{ trans(Session::get('reason')) }}
			@elseif (Session::has('success'))
				An e-mail with the password reset has been sent.
			@endif

			<p>Enter your email address below and we'll send you a link to reset your password.</p>

			{{ Form::open(array('action' => 'AuthController@postForgotPassword', 'role' => 'form')) }}
				
				<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
					<label for="inputEmail" class="control-label">Email address</label>
					<input type="email" id="inputEmail" name="email" class="form-control" value="{{ Input::old('email') }}">
					{{ $errors->first('email', '<span class="help-block">:message</span>') }}
				</div>

				<button type="submit" class="btn btn-primary btn-lg btn-block">Reset password</button>

			{{ Form::close() }}

		</div>

		<div class="panel-footer">
			<a class="pull-left" href="{{ URL::route('home-index') }}">Back to home page</a>
			<a class="pull-right" href="{{ URL::route('auth-login') }}">Login</a><br>
		</div>

	</div>

</div>

@stop