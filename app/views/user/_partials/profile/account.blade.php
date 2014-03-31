<div class="panel panel-default">
				
	<div class="panel-heading">
		<h3 class="panel-title"><strong>Change Password</strong></h3>
	</div> <!-- /.panel-heading -->

	<div class="panel-body">
		<div class="row">
			<div class="col-md-6">

				{{ Form::open(array('route' => 'user-update-password', 'role' => 'form')) }}
				
					{{ Form::hidden('email', $user->email) }}

					<div class="form-group {{ $errors->has('old_password') ? 'has-error' : '' }}">
						<label for="inputOldPassword" class="control-label">Old Password</label>
						<input type="password" id="inputOldPassword" name="old_password" class="form-control">
						{{ $errors->first('old_password', '<span class="help-block">:message</span>') }}
					</div>

					<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
						<label for="inputPassword" class="control-label">New Password</label>
						<input type="password" id="inputPassword" name="password" class="form-control">
						{{ $errors->first('password', '<span class="help-block">:message</span>') }}
					</div>

					<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
						<label for="inputPasswordConfirmation" class="control-label">Confirm New Password</label>
						<input type="password" id="inputPasswordConfirmation" name="password_confirmation" class="form-control">
						{{ $errors->first('password_confirmation', '<span class="help-block">:message</span>') }}
					</div>

					<button type="submit" class="btn btn-primary">Update password</button>

				{{ Form::close() }}

			</div>
		</div>
	</div> <!-- /.panel-body -->
</div> <!-- /.panel -->

