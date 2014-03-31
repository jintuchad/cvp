<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ URL::to('dashboard') }}">Dashboard</a>
		</div>

		<div class="collapse navbar-collapse" id="navbar-collapse-1">
			
			<ul class="nav navbar-nav navbar-left">

				@if (Auth::user()->can('view_user'))
				<li {{ (Request::is('dashboard/users') ? 'class="active"' : '') }}><a href="{{ URL::to('dashboard/users') }}">Users</a></li>
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
				
				@endif

			</ul>

		</div><!-- /.navbar-collapse -->
	</div>
</nav>