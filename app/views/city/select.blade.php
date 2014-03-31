@extends('layouts.default')

@section('title')
Select a city!
@stop

@section('styles')
@parent
.modal-selectcity {
	text-align: center;
}
@stop

@section('content')

<div class="container">
	
	<div class="modal-selectcity">
		
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<h4 class="modal-title"><strong>Please select a city</strong></h4>
				</div>

				<div class="modal-body">

					<ul class="list-unstyled">
						@foreach($cities as $city)
							<li><h4><a href="{{ URL::to($city->slug) }}">{{ $city->name }}</a></h4></li>
						@endforeach
					</ul>
					
				</div>

				<div class="modal-footer">
					<p>Have an account? <a href="{{ URL::route('auth-login') }}">Log in</a>. No? <a href="{{ URL::route('user-register') }}">Create one</a>.</p>
				</div>

			</div>
		</div>

	</div>

</div>

@stop