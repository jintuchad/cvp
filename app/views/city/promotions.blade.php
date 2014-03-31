@extends('layouts.city')

@section('title')
{{ $city->name }} VIP Pass
@stop

@section('styles')
@parent
.modal-selectcity {
	text-align: center;
}
@stop

@section('content')

@include('city._partials.header')

<div class="container">
	<div class="row">
		
		<div class="col-sm-12 bg-light rounded">
			<div class="cities-content">

			<!-- Deal list -->
			@if ($deals->count())

				<ul class="unstyled city-list">
				@foreach ($deals as $deal)
					
					<li class="city-item deal">
						<a href="{{ URL::to('deal/'.$deal->pivot->id.'-'.$deal->slug) }}">

							<div class="top">
								<p class="category">
									<span>{{ $deal->dealcategory->name }}</span>
								</p>
								{{ HTML::image('/img/dealpic-thumbs-3/'.$deal->listThumbnail()->filename) }}
							</div>
							
							<div class="bottom">
								
								<p class="name">{{ $deal->name }}</p>
								<p class="heading">{{ $deal->heading }}</p>
								<p class="meta">

									<!-- prices & values -->
									@if ($deal->stickerPrice != $deal->stickerValue)
										<span class="price"><sup class="dollar_sign">$</sup>{{ ddv($deal->stickerPrice) }}</span>
										<span class="value">(<sup class="dollar_sign">$</sup>{{ ddv($deal->stickerValue) }} value)</span>
									@else
										<span class="price solo"><sup class="dollar_sign">$</sup>{{ ddv($deal->stickerPrice) }}</span>
									@endif

									<span class="totalsold">{{ $deal->pivot->sales_boost }}</span>
									<span class="sold_label">sold</span>

									<button class="btn btn-default btn-lg" type="button">View</button>

								</p>
							</div>

						</a>
					</li>

				@endforeach
				</ul>


			<!-- No promotions :( -->
			@else
				
				<div style="text-align:center;">
					<div style="margin: 100px auto;">
						<h3>Oops! We couldn't find any deals.</h3>
						@if (Request::segment(2))
							<h4><a href="{{ URL::to($city->slug) }}">Go back.</a></h4>
						@else
							<h4><a href="{{ URL::route('city-index') }}">Select a different city.</a></h4>
						@endif
					</div>					
				</div>		

			@endif

			</div>	<!-- /cities-content -->
		</div>
	</div> <!-- /row -->
</div> <!-- /container -->

@stop