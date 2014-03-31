@extends('layouts.dashboard')

@section('content')

<div class="container">

	<div class="form-style-1">

		<div class="row">
			
			<div class="col-md-6">
				
				<h2 class="form-heading">Users</h2>

			</div>

			<div class="col-md-6">

				<div style="text-align: right;">
				@if (Auth::user()->can('create_user'))
					<a style="margin-top:15px;" class="btn btn-primary" href="{{ URL::route('dashboard.users.create') }}">Add User</a>
				@endif
				</div>
				
			</div>
		</div>

		<div class="row" style="margin-top:10px;">

			<div class="col-md-3">
				
				<p>{{ $users->count() }} users found</p>

			</div>

			<div class="col-md-9">
				
				<table class="table table-condensed">
					<thead>
						<tr>
							<th>{{ link_to_sort_route_by_name('dashboard.users.index', 'email', 'Email') }}</th>
							
							<th>{{ link_to_sort_route_by_name('dashboard.users.index', 'locale', 'Locale') }}</th>

							<th>{{ link_to_sort_route_by_name('dashboard.users.index', 'disabled', 'Disabled') }}</th>
							
							<th>{{ link_to_sort_route_by_name('dashboard.users.index', 'last_login', 'Last Login') }}</th>

							@if (Auth::user()->can('edit_user'))
								<th>{{ link_to_sort_route_by_name('dashboard.users.index', 'updated_at', 'Last Updated') }}</th>
							@endif
						</tr>
					</thead>
					@foreach($users as $user)
					<tbody>
						<tr>
							<td>
								@if (Auth::user()->can('edit_user'))
									<a href="{{ URL::route('dashboard.users.edit', Crypt::encrypt($user->id)) }}">{{ $user->email }}</a>
								@else
									<a href="{{ URL::route('dashboard.users.show', Crypt::encrypt($user->id)) }}">{{ $user->email }}</a>
								@endif
							</td>
							
							<td>{{ strtoupper($user->locale) }}</td>

							<td>{{ ($user->disabled) ? 'Yes' : '' }}</td>
							
							<td>{{ $user->updated_at->diffForHumans() }}</td>

							@if (Auth::user()->can('edit_user'))
								<td>{{{ is_null($user->last_login) ? 'never' : $user->last_login->diffForHumans() }}}</td>
							@endif
						</tr>
					</tbody>
					@endforeach
				</table>

				<div style="text-align: center;">{{ $users->links() }}</div>
				
			</div>

		</div>

	</div>

</div>

@stop