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
			<div id="aside" class="col-md-3">
				<form action="{{ url('/searchoption/'.session()->get('option').'/'.session()->get('key')) }}" method="get">
					<!-- aside Widget -->
					<div class="aside">
						<h3 class="aside-title">Brand</h3>
						<div class="checkbox-filter">
							<?php foreach ($allmanus as $value) {
								$summanu = 0;
								foreach ($allsearchs as $s) {
									if ($s->manu_id == $value->manu_id) {
										$summanu++;
									}
								} ?>
								<div class="input-checkbox">
									<input type="checkbox" name="check[]" value="{{ $value->manu_id }}" id="category-{{ $value->manu_id }}">
									<label for="category-{{ $value->manu_id }}">
										<span></span>
										{{ $value->manu_name }}
										<small>{{ $summanu }}</small>
									</label>
								</div>
							<?php } ?>
						</div>
					</div>
					<!-- /aside Widget -->

					<!-- aside Widget -->
					<div class="aside">
						<h3 class="aside-title">Price</h3>
						<div class="price-filter">
							<div id="price-slider"></div>
							<div class="input-number price-min">
								<input id="price-min" type="number" name="min">
								<span class="qty-up">+</span>
								<span class="qty-down">-</span>
							</div>
							<span>-</span>
							<div class="input-number price-max">
								<input id="price-max" type="number" name="max">
								<span class="qty-up">+</span>
								<span class="qty-down">-</span>
							</div>
						</div>
					</div>
					<!-- /aside Widget -->
					<div style="padding: 20px 0;">
						<input style="font-weight: 100; width: 260px;" class="add-to-cart-btn" type="submit" value="Search" name="search">
					</div>
				</form>

				<!-- aside Widget -->
				<div class="aside">
					<h3 class="aside-title">Top selling</h3>
					@foreach($topsellings as $value)
					<div class="product-widget">
						<div class="product-img">
							<a href="{{ url('/products/'.$value->product_id.'/'.$value->manu_id) }}"><img src="{{ asset('img/'.$value->image) }}" alt=""></a>
						</div>
						<div class="product-body">
							<p class="product-category">{{ $value->manufacturers->manu_name }}</p>
							<h3 class="product-name"><a href="{{ url('/products/'.$value->product_id.'/'.$value->manu_id) }}">{{ $value->product_name }}</a></h3>
							<?php if ($value->sale > 0) { ?>
								<h4 class="product-price">{{ number_format($value->price - ($value->price * $value->sale / 100)) . "đ " }}<del class="product-old-price">{{ number_format($value->price)."đ" }}</del></h4>
							<?php } else { ?>
								<h4 class="product-price">{{ number_format($value->price)."đ" }}</h4>
							<?php } ?>
						</div>
					</div>
					@endforeach
				</div>
				<!-- /aside Widget -->
			</div>
			<!-- /ASIDE -->

			<!-- STORE -->
			<div id="store" class="col-md-9">
				<!-- store top filter -->
				<div class="store-filter clearfix">
					<div class="store-sort">
						<label>
							<form action="{{ url('/sort/'.session()->get('option').'/'.session()->get('key')) }}" method="get">
								Sort By The Money:
								<select class="input-select" name="sort">
									<option value="asc">Small -> large</option>
									<option value="desc">Large -> small</option>
								</select>
								<input type="submit" value="Sort">
							</form>
						</label>
					</div>
					<ul class="store-grid">
						<li class="active"><i class="fa fa-th"></i></li>
						<li><a href="#"><i class="fa fa-th-list"></i></a></li>
					</ul>
				</div>
				<!-- /store top filter -->

				<!--store products-->
				<!-- /product -->
				<div class="row">
					@foreach($search as $value)
					<!-- product -->
					<div class="col-md-4 col-xs-6">
						<div class="product">
							<div class="product-img">
								<a href="{{ url('/products/'.$value->product_id.'/'.$value->manu_id) }}"><img src="{{ asset('img/'.$value->image) }}" alt=""></a>
								<?php if ($value->sale > 0) { ?>
									<div class="product-label">
										<span class="sale">{{ "-".$value->sale."%" }}</span>
										<span class="new">NEW</span>
									</div>
								<?php } else { ?>
									<div class="product-label">
										<span class="new">NEW</span>
									</div>
								<?php } ?>
							</div>
							<div class="product-body">
								<p class="product-category">{{ $value->manufacturers->manu_name }}</p>
								<h3 class="product-name"><a href="{{ url('/products/'.$value->product_id.'/'.$value->manu_id) }}">{{ $value->product_name }}</a></h3>
								<?php if ($value->sale > 0) { ?>
									<h4 class="product-price">{{ number_format($value->price - ($value->price * $value->sale / 100)) . "đ " }}<del class="product-old-price">{{ number_format($value->price)."đ" }}</del></h4>
								<?php } else { ?>
									<h4 class="product-price">{{ number_format($value->price)."đ" }}</h4>
								<?php } ?>
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
									<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
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