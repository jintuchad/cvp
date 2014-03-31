<div class="container">
	<div class="row" style="margin-bottom:20px;">
		
		<div class="city-header">

			<div class="col-md-5 citybrand">
				<a href="{{ URL::to($city->slug) }}"><h1>{{ $city->name }} VIP Pass</h1></a>
			</div>
			
			<ul class="col-md-7 unstyled dc-list">										
				@foreach ($dealcategories as $dc)					
					<li class="dc-item{{ (isset($dealcategory)) && ($dealcategory->id == $dc->id) ? ' active' : '' }}">
						<div class="wrapper">
							@if ((isset($dealcategory)) && ($dealcategory->id == $dc->id))
								<a href="{{ URL::to($city->slug.'/'.$dc->slug.'/remove') }}">{{ $dc->name }}</a>
							@else
								<a href="{{ URL::to($city->slug.'/'.$dc->slug) }}">{{ $dc->name }}</a>
							@endif
						</div>					
					</li>
				@endforeach
			</ul>

		</div> <!-- /.city-header -->
		
	</div> <!-- /.row -->
</div> <!-- /.container -->