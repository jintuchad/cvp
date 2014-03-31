<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>

		<div class="collapse navbar-collapse" id="navbar-collapse-1">
			
			<ul class="nav navbar-nav navbar-left">

				@if (Request::segment(1) === 'deal')
					
					<li><a href="{{ URL::to($city->slug) }}">Back to {{ $city->name }}</a></li>

				@else
					
					{{-- back to favorite --}}

					@if (Session::has('user_active_city') && Session::has('user_default_city'))
						@if (Session::get('user_active_city')->id != Session::get('user_default_city')->id)
							<li><a href="{{ URL::to(Session::get('user_default_city')->slug) }}">Back to {{ Session::get('user_default_city')->name }}</a></li>
						@endif
					@endif

					{{-- select other cities --}}

					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">See other cities <b class="caret"></b></a>
						<ul class="dropdown-menu">
							@foreach ($cities as $c)
								@unless ($c->id == $city->id)
									<li><a href="{{ URL::to($c->slug) }}">{{ $c->name }}</a></li>
								@endunless
							@endforeach
						</ul>
					</li>

				@endif

			</ul>

			<ul class="nav navbar-nav navbar-right">
				
			{{-- TODO: cart notification --}}

				@if (Auth::check())
				
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->email }} <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="{{ URL::route('user-profile') }}"><span class="glyphicon glyphicon-cog"></span> Profile</a></li>
							<li class="divider"></li>
							<li><a href="{{ URL::route('auth-logout') }}">Logout</a></li>
						</ul>
					</li>

				@else
				
					<li {{ (Request::is('login') ? 'class="active"' : '') }}><a href="{{ URL::route('auth-login') }}">Login</a></li>
					<li {{ (Request::is('user/register') ? 'class="active"' : '') }}><a href="{{ URL::route('user-register') }}">Register</a></li>
				
				@endif

			</ul>

		</div><!-- /.navbar-collapse -->
	</div>
</nav>