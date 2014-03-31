@extends('layouts.dashboard')

@section('title')
{{ (isset($edit_form)) ? 'Edit User' : 'View User' }}
@stop

@section('content')

<div class="container">

	<div class="form-style-1">

		<div class="row">
			
			<div class="col-md-12">
				
				<h2 class="form-heading">{{ (isset($edit_form)) ? 'Edit User' : 'View User' }}</h2>

			</div>

		</div>

		<div class="row" style="margin-top:10px;">

			<div class="col-md-12">
				
				{{ Form::open(array('route' => array('dashboard.users.update', Crypt::encrypt($user->id)), 'method' => 'put', 'class' => 'form-horizontal', 'role' => 'form')) }}					

					<!-- email / verification status -->
					<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
						<label for="inputEmail" class="col-sm-4 control-label">Email address</label>
						<div class="col-sm-4">
							
							<p class="form-control-static">{{ $user->email }}

								@if (!$user->verified)
									
									<br><br>This user is not verified!

									@if(isset($edit_form))

										<br><a href="'.URL::route('dashboard.users.verification_reminder', Crypt::encrypt($user->id)).'">Send verification email</a>

									@endif

								@endif

							</p>
						</div>
						<div class="col-sm-4"></div>
					</div>

					<!-- verification status -->

					@if (!$user->verified)

					@endif

					<!-- change password -->

					@if (Auth::user()->can('change_user_password'))

					<div style="margin-top:50px; margin-bottom: 50px;">

						<!-- password -->
						<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
							<label for="inputPassword" class="col-sm-4 control-label">Change Password</label>
							<div class="col-sm-4">
								<input type="password" id="inputPassword" name="password" class="form-control">
								{{ $errors->first('password', '<span class="help-block">:message</span>') }}
							</div>
							<div class="col-sm-4"></div>
						</div>

						<!-- password_confirmation -->
						<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
							<label for="inputPasswordConfirmation" class="col-sm-4 control-label">Confirm New Password</label>
							<div class="col-sm-4">
								<input type="password" id="inputPasswordConfirmation" name="password_confirmation" class="form-control">
								{{ $errors->first('password_confirmation', '<span class="help-block">:message</span>') }}
							</div>
							<div class="col-sm-4"></div>
						</div>

					</div>

					@endif

					<!-- locale -->
					<div class="form-group {{ $errors->has('locale') ? 'has-error' : '' }}">
						<label for="inputLocale" class="col-sm-4 control-label">Preferred Language</label>
						<div class="col-sm-4">
							@if(isset($edit_form))
								{{ Form::select('locale', $langs, (Input::old('locale')) ?: $user->locale, array('id'=>'inputLocale', 'class'=>'form-control')) }}
								{{ $errors->first('locale', '<span class="help-block">:message</span>') }}
							@else
								<p class="form-control-static">{{ getLocaleDescription($user->locale) }}</p>
							@endif
						</div>
						<div class="col-sm-4"></div>
					</div>

					<!-- roles -->
					<div class="form-group">
						<label for="inputRole" class="col-sm-4 control-label">Role</label>
						<div class="col-sm-4">
							@if(isset($edit_form))
								{{ Form::select('role', $available_roles, (Input::old('role')) ?: $user->getRole('id'), array('id'=>'inputRole', 'class'=>'form-control')) }}
								{{ $errors->first('role', '<span class="help-block">:message</span>') }}
							@else
								<p class="form-control-static">{{ $user->getRole('name') }}</p>
							@endif
						</div>
						<div class="col-sm-4"></div>
					</div>

					<!-- buttons -->
					<div class="col-sm-12" style="text-align:center; margin-top: 30px;">
						@if(isset($edit_form))
							
							<a href="{{ URL::route('dashboard.users.index') }}" class="btn btn-link btn-lg" style="margin-right: 20px;">Cancel</a>
							<button type="submit" class="btn btn-primary btn-lg" style="margin-right: 20px;">Update</button>

							<!-- disable/enable -->
							@if (!$user->disabled)
								<button class="btn btn-warning btn-lg" data-toggle="modal" data-target=".disable-user-modal-sm" style="margin-right: 20px;">Disable</button>
							@else
								<button class="btn btn-success btn-lg" data-toggle="modal" data-target=".enable-user-modal-sm" style="margin-right: 20px;">Enable</button>
							@endif
							

							<!-- delete -->
							@if (Auth::user()->can('delete_user'))
								<button class="btn btn-danger btn-lg" data-toggle="modal" data-target=".delete-user-modal-sm" style="margin-right: 20px;">Delete</button>
							@endif

						@else
							
							<a href="{{ URL::route('dashboard.users.index') }}" class="btn btn-primary btn-lg">Back to users</a>
						
						@endif
					</div>

				{{ Form::close() }}

			</div>

		</div>

	</div>

</div>

<!-- modal: disable user -->
<div class="modal fade disable-user-modal-sm" tabindex="-1" role="dialog" aria-labelledby="userDisableLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="userDisableLabel">Are you sure?</h4>
			</div>

			<div class="modal-body">
				
				<p>Are you sure you want to <i>disable</i> <strong>{{ $user->email }}</strong>?</p>
				
				{{ Form::open(array('route' => array('dashboard.users.update', Crypt::encrypt($user->id)), 'method' => 'put', 'class' => 'form-horizontal', 'role' => 'form')) }}
				{{ Form::hidden('disable', 1) }}

			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-warning">Disable User</button>
				{{ Form::close() }}
			</div>

		</div>
	</div>
</div>

<!-- modal: enable user -->
<div class="modal fade enable-user-modal-sm" tabindex="-1" role="dialog" aria-labelledby="userEnableLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="userEnableLabel">Are you sure?</h4>
			</div>

			<div class="modal-body">
				
				<p>Are you sure you want to <i>enable</i> <strong>{{ $user->email }}</strong>?</p>
				
				{{ Form::open(array('route' => array('dashboard.users.update', Crypt::encrypt($user->id)), 'method' => 'put', 'class' => 'form-horizontal', 'role' => 'form')) }}
				{{ Form::hidden('enable', 1) }}

			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-success">Enable User</button>
				{{ Form::close() }}
			</div>

		</div>
	</div>
</div>

<!-- modal: delete user -->
<div class="modal fade delete-user-modal-sm" tabindex="-1" role="dialog" aria-labelledby="userDeleteLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="userDeleteLabel">Are you sure?</h4>
			</div>

			<div class="modal-body">
				<p>Are you sure you want to <i>delete</i> <strong>{{ $user->email }}</strong>?</p>
			{{ Form::open(array('route' => array('dashboard.users.destroy', Crypt::encrypt($user->id)), 'method' => 'delete', 'class' => 'form-horizontal', 'role' => 'form')) }}
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-danger">Delete User</button>
				{{ Form::close() }}
			</div>

		</div>
	</div>
</div>

@stop