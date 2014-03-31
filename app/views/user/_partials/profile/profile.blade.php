<div class="panel panel-default">
				
	<div class="panel-heading">
		<h3 class="panel-title"><strong>Profile</strong></h3>
	</div> <!-- /.panel-heading -->

	<div class="panel-body">
		<div class="row">
			<div class="col-md-6">

				{{ Form::open(array('role' => 'form')) }}

				<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
					<label for="inputName" class="control-label">Name</label>
					<input type="text" id="inputName" name="name" class="form-control" value="{{ Input::old('name') }}">
					{{ $errors->first('name', '<span class="help-block">:message</span>') }}
				</div>

				<button type="submit" class="btn btn-primary">Update</button>

				{{ Form::close() }}

			</div>

			<div class="col-md-3">
				
				<img src="{{ array_get($data, 'gravatar.src') }}" alt="gravatar image" class="img-rounded" style="margin-top:20px;">
				<p><a href="https://gravatar.com/" target="_blank">Change your avatar at Gravatar.com</a>.</p>

			</div>
		</div>
	</div> <!-- /.panel-body -->
</div> <!-- /.panel -->

