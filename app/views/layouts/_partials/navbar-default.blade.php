<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ (Auth::check()) ? URL::route('dashboard-index') : URL::route('home-index') }}">{{ (Auth::check()) ? '<< Back to dashboard' : '<< Back to home page' }}</a>
		</div>

		<div class="collapse navbar-collapse" id="navbar-collapse-1">
			
			<ul class="nav navbar-nav navbar-left">

				@if (Session::has('city.active.slug'))
					<li><a class="btn btn-inverse pull-left" href="{{ URL::to(Session::get('city.active.slug')) }}"><i class="icon-chevron-left icon-white"></i> Back to {{ Session::get('city.active.name') }}</a></li>
				@elseif (Session::has('city.favorite.slug'))
					<li><a class="btn btn-inverse pull-left" href="{{ URL::to(Session::get('city.favorite.slug')) }}"><i class="icon-chevron-left icon-white"></i> Back to {{ Session::get('city.favorite.name') }}</a></li>
				@endif

			</ul>

			<ul class="nav navbar-nav navbar-right">
				
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