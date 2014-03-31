<div class="panel panel-default">
				
	<div class="panel-heading">
		<h3 class="panel-title"><strong>Language</strong></h3>
	</div> <!-- /.panel-heading -->

	<div class="panel-body">
		<div class="row">
			<div class="col-md-6">

				{{ Form::open(array('route' => 'user-update-localization', 'role' => 'form')) }}
				
					<div class="form-group {{ $errors->has('locale') ? 'has-error' : '' }}">
						<label for="inputLocale" class="control-label">Display Language</label>
						{{ Form::select('locale', $langs, $user->locale, array('id'=>'inputLocale', 'class'=>'form-control')) }}
						{{ $errors->first('locale', '<span class="help-block">:message</span>') }}
					</div>

					<button type="submit" class="btn btn-primary">Update</button>

				{{ Form::close() }}

			</div>
		</div>
	</div> <!-- /.panel-body -->
</div> <!-- /.panel -->
