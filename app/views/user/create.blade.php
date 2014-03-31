@extends('layouts.dashboard')

@section('title')
Create User
@stop

@section('content')

<div class="container">

	<div class="form-style-1">

		<div class="row">
			
			<div class="col-md-12">
				
				<h2 class="form-heading">Create User</h2>

			</div>

		</div>

		<div class="row" style="margin-top:10px;">

			<div class="col-md-12">
				
				{{ Form::open(array('route' => 'dashboard.users.store', 'class' => 'form-horizontal', 'role' => 'form')) }}					

					<!-- email -->
					<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
						<label for="inputEmail" class="col-sm-4 control-label">Email address</label>
						<div class="col-sm-4">
							<input type="email" id="inputEmail" name="email" class="form-control" value="{{ Input::old('email') }}">
							{{ $errors->first('email', '<span class="help-block">:message</span>') }}
						</div>
					</div>

					<!-- check: generate_password? -->
					<div class="row" style="margin-bottom: 20px;">
						<div class="col-sm-4 col-md-offset-4">
							<div class="checkbox">
								<label>
									<input name="generate_password" type="checkbox" id="chkGeneratePassword" value="1" tabindex="2" {{ (Input::old('submitted')) ? ( (Input::old('generate_password')) ? 'checked' : '' ) : 'checked' }}> Generate password
								</label>
							</div>
						</div>
					</div>

					<!-- password -->
					<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
						<label for="inputPassword" class="col-sm-4 control-label">Password</label>
						<div class="col-sm-4">
							<input type="password" id="inputPassword" name="password" class="form-control pwinput" disabled>
							{{ $errors->first('password', '<span class="help-block">:message</span>') }}
						</div>
					</div>

					<!-- password_confirmation -->
					<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
						<label for="inputPasswordConfirmation" class="col-sm-4 control-label">Confirm Password</label>
						<div class="col-sm-4">
							<input type="password" id="inputPasswordConfirmation" name="password_confirmation" class="form-control pwinput" disabled>
							{{ $errors->first('password_confirmation', '<span class="help-block">:message</span>') }}
						</div>
					</div>

					<!-- locale -->
					<div class="form-group {{ $errors->has('locale') ? 'has-error' : '' }}">
						<label for="inputLocale" class="col-sm-4 control-label">Preferred Language</label>
						<div class="col-sm-4">
							{{ Form::select('locale', $langs, '', array('id'=>'inputLocale', 'class'=>'form-control')) }}
							{{ $errors->first('locale', '<span class="help-block">:message</span>') }}
						</div>
					</div>

					<!-- roles -->
					<div class="form-group">
						<label for="inputRole" class="col-sm-4 control-label">Assign Role</label>
						<div class="col-sm-4">
							{{ Form::select('role', $available_roles, '', array('id'=>'inputRole', 'class'=>'form-control')) }}
							{{ $errors->first('role', '<span class="help-block">:message</span>') }}
						</div>
					</div>

					<!-- check: auto-verify? -->
					<div class="row">
						<div class="col-sm-4 col-md-offset-4">
							<div class="checkbox">
								<label>
									<input name="verify" type="checkbox" value="1" tabindex="7" {{ (Input::old('submitted')) ? ( (Input::old('verify')) ? 'checked' : '' ) : 'checked' }}> Auto-verify this user
								</label>
							</div>
						</div>
					</div>

					<!-- check: welcome email? -->
					<div class="row">
						<div class="col-sm-4 col-md-offset-4">
							<div class="checkbox">
								<label>
									<input name="welcome" type="checkbox" value="1" tabindex="8" {{ (Input::old('submitted')) ? ( (Input::old('welcome')) ? 'checked' : '' ) : 'checked' }}> Email this user their credentials
								</label>
							</div>
						</div>
					</div>

					<!-- buttons -->
					<div style="text-align: center; margin-top: 30px;">
						<a href="{{ URL::route('dashboard.users.index') }}" class="btn btn-link btn-lg" style="margin-right: 20px;">Cancel</button>
						<button type="submit" class="btn btn-primary btn-lg" style="margin-left: 20px;">Create</button>
					</div>

					{{ Form::hidden('submitted', 1) }}

				{{ Form::close() }}

			</div>

		</div>

	</div>

</div>

<script type="text/javascript">
$(document).ready(function() {

	if ($('#chkGeneratePassword').is(':checked')) {
		$('.pwinput').attr('disabled', 1);
	} else {
		$('.pwinput').prop("disabled", false);
	}

	$('#chkGeneratePassword').click(function(){   
		$('.pwinput').attr('disabled', this.checked)
	});
});
</script>

@stop