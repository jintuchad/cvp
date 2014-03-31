@extends('layouts.default')

@section('title')
Register - 
@parent
@stop

@section('styles')
@parent
#panel-register {
	width: 400px;
	margin: 160px auto;
}
@stop

@section('content')

<div class="container">

	<div class="panel panel-default" id="panel-register">

		<div class="panel-heading">
			<h3 class="panel-title">Register</h3>
		</div>

		<div class="panel-body">

			@if(Auth::check())

				<p><strong>Stop!</strong> You are already logged in as:<br><br><strong>{{ Auth::user()->email }}</strong>.<br><br>Would you like to <a href="{{ URL::route('auth-logout') }}">discontinue your current session</a> and log in as a different user, or return to the <a href="{{ URL::route('home-index') }}">home page</a>?</p>

			@else

				{{ Form::open(array('action' => 'UserController@postRegister', 'role' => 'form')) }}
					
					<!-- email -->
					<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
						<label for="inputEmail" class="control-label">Email address</label>
						<input type="email" id="inputEmail" name="email" class="form-control" value="{{ Input::old('email') }}">
						{{ $errors->first('email', '<span class="help-block">:message</span>') }}
					</div>

					<!-- password -->
					<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
						<label for="inputPassword" class="control-label">Password</label>
						<input type="password" id="inputPassword" name="password" class="form-control">
						{{ $errors->first('password', '<span class="help-block">:message</span>') }}
					</div>

					<!-- password_confirmation -->
					<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
						<label for="inputPasswordConfirmation" class="control-label">Confirm Password</label>
						<input type="password" id="inputPasswordConfirmation" name="password_confirmation" class="form-control">
						{{ $errors->first('password_confirmation', '<span class="help-block">:message</span>') }}
					</div>

					<!-- locale -->
					<div class="form-group {{ $errors->has('locale') ? 'has-error' : '' }}">
						<label for="inputLocale" class="control-label">Preferred Language</label>
						{{ Form::select('locale', $langs, '', array('id'=>'inputLocale', 'class'=>'form-control')) }}
						{{ $errors->first('locale', '<span class="help-block">:message</span>') }}
					</div>

					<button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>

				{{ Form::close() }}

			@endif

		</div>

		<div class="panel-footer">
			<a href="{{ URL::route('home-index')}}">back to Home page</a>
		</div>

	</div>

</div>

@stop