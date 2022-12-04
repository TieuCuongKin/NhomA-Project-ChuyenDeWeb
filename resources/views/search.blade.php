@extends('layout')
@section('main-content')

<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<h3 class="breadcrumb-header">Search</h3>
				<ul class="breadcrumb-tree">
					<li><a href="{{ url('/') }}">Home</a></li>
					<li class="active">Search</li>
				</ul>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<!-- ASIDE -->
			<div id="aside" class="col-md-2">
				<form action="{{ url('/searchoption/'.session()->get('option').'/'.session()->get('key')) }}" method="get">
					<!-- aside Widget -->
					<div class="aside">
						<h3 class="aside-title">Company</h3>
						<div class="checkbox-filter">
							<?php foreach ($allmanus as $value) {
								$summanu = 0;
								foreach ($allsearchs as $s) {
									if ($s->company_name == $value->company_name) {
										$summanu++;
									}
								} ?>
								<div class="input-checkbox">
									<input type="checkbox" name="check[]" value="{{ $value->company_name }}" id="category-{{ $value->company_name }}">
									<label for="category-{{ $value->company_name }}">
										<span></span>
										{{ $value->company_name }}
										<small>{{ $summanu }}</small>
									</label>
								</div>
							<?php } ?>
						</div>
					</div>
			</div>
			<!-- /ASIDE -->
			<!-- STORE -->
			<div id="store" class="col-md-9">
			<div class="store-filter clearfix">
				<!-- /product -->
				<div class="row">
					@foreach($search as $value)
					<!-- product -->
					<div class="col-md-4 col-xs-3">
						<div class="product">
							<div class="product-img">
								<a href="{{ url('/products/'.$value->product_id.'/'.$value->id) }}"><img src="{{ asset('img/'.$value->image) }}" alt=""></a>
							</div>
							<div class="product-body">
								<p class="product-category">{{ $value->company_name }}</p>
								<h3 class="product-name"><a href="{{ url('/products/'.$value->product_id.'/'.$value->id) }}">{{ $value->product_name }}</a></h3>
								<div class="product-rating">
									<?php for ($i = 0; $i < 5; $i++) {
										if ($i < $value->star) { ?>
											<i class="fa fa-star"></i>
										<?php } else { ?>
											<i class="fa fa-star-o"></i>
									<?php }
									} ?>
								</div>
								<?php if ($user == NULL) { ?>
									<form action="{{ url('/others/search/'.$value->product_id.'/0/'.session()->get('option').'/'.session()->get('key')) }}" method="get">
										<div class="product-btns">
											<button name="action" value="wishlist" class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
											<?php if (session()->has('compare' . $value->product_id)) { ?>
												<button name="action" value="compare" class="add-to-compare"><i style="color:red;" class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
											<?php } else { ?>
												<button name="action" value="compare" class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
											<?php } ?>
											<button name="action" value="view" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
										</div>
									</form>
								<?php } else { ?>
									<form action="{{ url('/others/search/'.$value->product_id.'/'.$user->id.'/'.session()->get('option').'/'.session()->get('key')) }}" method="get">
										<div class="product-btns">
											<?php $like = 0;
											foreach ($user->others as $other) {
												if ($other->product_id == $value->product_id && $other->like == "1") {
													$like = 1; ?>
													<button name="action" value="wishlist" class="add-to-wishlist"><i style="color:red;" class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
												<?php }
											}
											if ($like == 0) { ?>
												<button name="action" value="wishlist" class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
											<?php }
											if (session()->has('compare' . $value->product_id)) { ?>
												<button name="action" value="compare" class="add-to-compare"><i style="color:red;" class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
											<?php } else { ?>
												<button name="action" value="compare" class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
											<?php } ?>
											<button name="action" value="view" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
										</div>
									</form>
								<?php } ?>
							</div>
							<div class="add-to-cart">
								<a href="{{ url('/carts/add/'.$value->product_id) }}">
									<button class="add-to-cart-btn"><i class="fa-solid fa-file"></i> Apply Jobs</button>
								</a>
							</div>
						</div>
					</div>
					
					<!-- /product -->
					@endforeach
				</div>

				<!-- /store products -->
				<hr>
				<div class="row">
					<div class="col-md-12 text-right">
						{{ $search->appends(request()->all())->links() }}
					</div>
				</div>
				<!-- store bottom filter -->
			</div>
			<!-- /STORE -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

@endsection