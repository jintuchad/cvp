@extends('layouts.default')

@section('title')
Verify your account - 
@parent
@stop

@section('styles')
@parent
#panel-verify {
	width: 400px;
	margin: 160px auto;
}
@stop

@section('content')

<div class="container">

	<div class="panel panel-default" id="panel-verify">

		<div class="panel-heading">
			<h3 class="panel-title">Verify your account</h3>
		</div>

		<div class="panel-body">

			@if(Auth::check())

				<p><strong>Stop!</strong> Your account has already been verified.<br><br>Would you like to <a href="{{ URL::route('auth-logout') }}">discontinue your current session</a> and log in as a different user, or return to the <a href="{{ URL::route('home-index') }}">home page</a>?</p>

			@else

				{{ Form::open(array('action' => 'UserController@postVerify', 'role' => 'form')) }}
					
					<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
						<label for="inputEmail" class="control-label">Email address</label>
						<input type="email" id="inputEmail" name="email" class="form-control" value="{{ (isset($user->email)) ? $user->email : ((Input::old('email')) ?: '')}}">
						{{ $errors->first('email', '<span class="help-block">:message</span>') }}
					</div>

					{{ Form::hidden('crypt_user_id', $crypt_user_id) }}

					<button type="submit" class="btn btn-primary btn-lg btn-block">Verify</button>

				{{ Form::close() }}

			@endif

		</div>

		<div class="panel-footer">
			<a href="{{ URL::route('home-index')}}">back to Home page</a>
		</div>

	</div>

</div>

@stop