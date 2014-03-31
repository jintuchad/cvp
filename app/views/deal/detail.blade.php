@extends('layouts.city')

@section('title')
{{ $city->name }} VIP Pass
@stop

@section('styles')
@parent
@stop

@section('content')

@include('city._partials.header')

<div class="container bg-white rounded deal-detail">
	
	<div class="row" style="padding-top:20px;">

		<!-- left-column -->
		<div class="col-sm-7" style="margin-bottom: 20px;">

			<div style="padding-left:20px;">

				<!-- Carousel : dealFeaturePics -->
				<div id="features" class="carousel slide" data-ride="carousel" style="margin-bottom: 20px;">
					
					@if ($dealFeaturePics->count() > 1)
						<ol class="carousel-indicators">
							<?php $i = 0; ?>
							@foreach ($dealFeaturePics as $dealpic)
							<li data-target="#features" data-slide-to="{{ $i }}"{{ (!$i) ? ' class="active"' : '' }}></li>
							<?php $i++; ?>
							@endforeach
						</ol>
					@endif

					<div class="carousel-inner">
						<?php $first = true; ?>
						@foreach ($dealFeaturePics as $dealpic)
							<div class="item {{ ($first) ? 'active' : ''}}">
								<img src="{{ asset('/img/dealpic-features/'.$dealpic->filename) }}" alt="" class="img-rounded">
							</div>
							<?php $first = false; ?>
						@endforeach
					</div>

					@if ($dealFeaturePics->count() > 1)
						<!-- Carousel nav -->
						<a class="carousel-control left" href="#features" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
						<a class="carousel-control right" href="#features" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
					@endif

				</div>
				<!-- /Carousel : dealFeaturePics -->

				@if ($dealTabs->count())
					
					<!-- dealTabs -->
					<div class="deal-tabs">
						<ul id="dealTab" class="nav nav-pills">
							@foreach ($dealTabs as $dealtab)
								<li><a href="#{{ $dealtab->slug }}" data-toggle="tab">{{ $dealtab->title }}</a></li>
							@endforeach
							<li><a href="#fine-print" data-toggle="tab">Fine Print</a></li>
						</ul>
						<div id="dealTabConent" class="tab-content">
							@foreach ($dealTabs as $dealtab)
								<div class="tab-pane" id="{{ $dealtab->slug }}" style="margin-top:15px;">{{ $dealtab->content }}</div>
							@endforeach
							<div class="tab-pane" id="fine-print">{{ $deal->fine_print_content }}</div>
						</div>
					</div>
					<!-- /dealTabs -->

				@endif
				
			</div> <!-- padding -->

		</div> <!-- /.col-sm-7 (left-column)-->

		<!-- right-column -->
		<div class="col-sm-5">

			<!-- headings -->
			<div class="headings" style="padding-right:20px;"> 

				<h1 class="text-right">{{ $deal->name }}</h1>
				<p class="text-right">{{ $deal->heading }}</p>

			</div>

			<div class="row" style="margin-top:20px;">
				
				<?php 
					$savings = ($deal->stickerValue - $deal->stickerPrice) / $deal->stickerValue;
					$buynow_class = 'btn btn-large btn-block btn-warning btn-buynow';
					$buynow_text = ($savings) ? 'Buy Now<br><span class="savings">and save '.round($savings*100, 0, PHP_ROUND_HALF_UP).'%</span>' : 'Buy Now';
				?>

				<!-- sticker price / value -->
				<div class="col-sm-4">
					
					<div class="sticker">
						<span class="price">{{ ($dealOptions->count() > 1) ? '<span class="from">From</span><br>' : '' }}<sup class="dollar_sign">$</sup>{{ ddv($deal->stickerPrice) }}</span>
						@if ($savings)
							<br><span class="value">(a <sup class="dollar_sign">$</sup>{{ ddv($deal->stickerValue) }} value)</span>
						@endif

					</div> <!-- /.sticker -->

				</div> <!-- /.col-sm-4 -->

				<!-- Button : buy now -->
				<div class="col-sm-8"{{ ($dealOptions->count() > 1) ? 'style="margin-top:20px;"' : '' }}>

					<div style="padding-right:20px;">

						<!-- Form : cart/add (if more than one dealoption, display modal for selection) -->
						@if ($dealOptions->count() === 1)
							
							{{ Form::open(array('route' => 'cart.store')) }}
							@foreach($dealOptions as $dealoption)
								{{ Form::hidden('dealoption_id', $dealoption->id) }}
							@endforeach
							{{ Form::hidden('price', $dealoption->price) }}
							{{ Form::hidden('uri', Request::path()) }}
							{{ Form::hidden('req_shipping', $dealoption->req_shipping) }}
							<button class="{{ $buynow_class }}" type="submit">{{ $buynow_text }}</button>
							{{ Form::close() }}

						@else
							
							<!-- TODO: make sure multiple dealoptions for a deal works! -->

							<button class="{{ $buynow_class }}" data-toggle="modal" data-target="#dealoptionsModal">{{ $buynow_text }}</button>

						@endif

					</div> <!-- /padding -->

				</div> <!-- /.col-sm-8 -->
			</div> <!-- /.row -->

			<div style="margin-top:20px;">
				<div style="padding-right:20px;">

					<?php $sales_total = $promotion->sales_boost + $deal->total_sales; ?>
					@if ($sales_total)

						<div class="alert alert-success" style="text-align:center; font-weight:bold;">
							{{ ($sales_total > 1) ? $sales_total.' people' : $sales_total.' person' }} bought this
						</div>

					@endif

				</div>
			</div>

		</div> <!-- /.col-sm-5 (right-column)-->
	</div> <!-- /.row -->
</div> <!-- /.container -->

<!-- Modal : dealoption selector -->
<div id="dealoptionsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Choose an option</h4>
			</div>

			<div class="modal-body">

				<table class="table">
				@foreach ($dealOptions as $dealoption)

					<!-- TODO: format prices and include savings % -->
					<tr>
						<tr>
						<td>{{ $dealoption->name }}</td>
						<td>{{ ddv($dealoption->price, true, true) }} ({{ ddv($dealoption->value, true, true) }} value)</td>
						<td>
							<!-- Form : cart/add -->
							{{ Form::open(array('route' => 'cart.store')) }}
							{{ Form::hidden('dealoption_id', $dealoption->id) }} 
							{{ Form::hidden('price', $dealoption->price) }}
							{{ Form::hidden('uri', Request::path()) }}
							{{ Form::hidden('req_shipping', $dealoption->req_shipping) }}
							<input class="btn btn-large btn-primary" type="submit" value="Buy now">
							{{ Form::close() }}
						</td>
					</tr>
						
					</tr>

				@endforeach
				</table>

			</div>

			<div class="modal-footer">
				<button class="btn pull-left" data-dismiss="modal" aria-hidden="true">Cancel</button>
			</div>

		</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	$('#features').carousel({interval: false});

	$('#dealTab a:first').tab('show');

	$('#dealTab a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	})
});
</script>

@stop