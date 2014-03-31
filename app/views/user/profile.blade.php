@extends('layouts.dashboard')

@section('title')
User Profile
@parent
@stop

@section('styles')
@parent
@stop

@section('content')

<div class="container">
	
	<div class="row" style="margin-top:20px;">
		<div class="col-md-3 col-sm-4">

			<div class="panel panel-default">
				
				<div class="panel-heading">
					
					<img src="{{ $gravatar['src'] }}" alt="gravatar image" class="img-gravatar-sm pull-left" style="margin-right:10px;">
					<h3 class="panel-title"><strong>{{ $user->username }}</strong></h3>

				</div>

				<div class="panel-body">
					
					<ul class="nav nav-pills nav-stacked" id="user-profile-sidenav">
						<li><a href="#account">Account Settings</a></li>
						<li><a href="#localization">Language & Localization</a></li>
						<li><a href="#notifications">Notification Center</a></li>
					</ul>

				</div>

			</div>

		</div>

		<div class="col-md-9 col-sm-8">
			
			<!-- Tab panes -->
			<div class="tab-content">
				
				<div class="tab-pane fade in active" id="account">
					
					@include('user._partials.profile.account')

				</div> <!-- /.tab-pane -->

				<div class="tab-pane fade" id="localization">
					
					@include('user._partials.profile.localization')

				</div> <!-- /.tab-pane -->

				<div class="tab-pane fade" id="notifications">
					
					@include('user._partials.profile.notifications')

				</div> <!-- /.tab-pane -->

			</div> <!-- /.tab-content -->

		</div>
	</div>

</div>

<script>
$(document).ready(function() {

	$('#user-profile-sidenav a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	})
});
</script>

@if ($show_tab)
<script>
$(document).ready(function() {
	$('#user-profile-sidenav a[href="#{{{ $show_tab }}}"]').tab('show')
});
</script>
@else
<script>
$(document).ready(function() {
	$('#user-profile-sidenav a:first').tab('show');
});
</script>
@endif

@stop