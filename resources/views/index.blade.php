@extends('layout')
@section('main-content')

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<?php for ($i = 0; $i < 3; $i++) { ?>
				<!-- shop -->
				<div class="col-md-4 col-xs-6">
					<div class="shop">
						<div class="shop-img">
							<img src="{{ asset('img/'.${'newproduct'.$i + 1}[$i]->image) }}" alt="">
						</div>
						<div class="shop-body">
							<h3><?php echo $allmanus[$i]->manu_name ?><br>Collection</h3>
							<a href="{{ url('/store') }}" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- /shop -->
			<?php } ?>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">New Products</h3>
					<div class="section-nav">
						<ul class="section-tab-nav tab-nav">
							<li class="active"><a data-toggle="tab" href="#np">Alls</a></li>
							@foreach($allmanus as $value)
							<li><a data-toggle="tab" href="#np{{ $value->manu_id }}">{{ $value->manu_name }}</a></li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
			<!-- /section title -->
			<!-- Products tab & slick -->
			<div class="col-md-12">
				<div class="row">
					<div class="products-tabs">
						<!-- tab -->
						<div id="np" class="tab-pane active">
							<div class="products-slick" data-nav="#slick-nav-np">
								<!-- product -->
								@foreach($newproducts as $value)
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
											<form action="{{ url('/others/index/'.$value->product_id.'/0') }}" method="get">
												<div class="product-btns">
													<button name="action" value="wishlist" class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
													<?php if (session()->has('compare' . $value->product_id)) { ?>
														<button name="action" value="compare" class="add-to-compare"><i style="color:red;" class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
													<?php } else { ?>
														<button name="action" value="compare" class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
													<?php } ?>
													<button class="quick-view" disabled>
														<i class="fa fa-eye"></i>
														<div class="toolshow product-details">
															<h2 class="product-price">{{ $value->product_name }}</h2>
															<div>
																<?php $temp = explode("#", $value->description); ?>
																<table>
																	<tbody>
																		@foreach($temp as $v)
																		<tr>{{ $v }}</tr><br>
																		@endforeach
																	</tbody>
																</table>
															</div>
														</div>
													</button>
												</div>
											</form>
										<?php } else { ?>
											<form action="{{ url('/others/index/'.$value->product_id.'/'.$user->id) }}" method="get">
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
													<button class="quick-view" disabled>
														<i class="fa fa-eye"></i>
														<div class="toolshow product-details">
															<h2 class="product-price">{{ $value->product_name }}</h2>
															<div>
																<?php $temp = explode("#", $value->description); ?>
																<table>
																	<tbody>
																		@foreach($temp as $v)
																		<tr>{{ $v }}</tr><br>
																		@endforeach
																	</tbody>
																</table>
															</div>
														</div>
													</button>
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
								@endforeach
								<!-- /product -->
							</div>
							<div id="slick-nav-np" class="products-slick-nav"></div>
						</div>
						<!-- /tab -->
						@foreach($allmanus as $manu)
						<!-- tab -->
						<div id="np{{ $manu->manu_id }}" class="tab-pane">
							<div class="products-slick" data-nav="#slick-nav-np{{ $manu->manu_id }}">
								<!-- product -->
								@foreach(${'newproduct'.$manu->manu_id} as $value)
								<div class="product">
									<div class="product-img">
										<a href="{{ url('/products/'.$value->product_id.'/'.$value->manu_id) }}"><img src="{{ asset('img/'.$value->image) }}" alt=""></a>
										<?php if ($value->sale > 0) { ?>
											<div class="product-label">
												<span class="sale">{{ "-".$value->sale."%" }}</span>
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
											<form action="{{ url('/others/index/'.$value->product_id.'/0') }}" method="get">
												<div class="product-btns">
													<button name="action" value="wishlist" class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
													<?php if (session()->has('compare' . $value->product_id)) { ?>
														<button name="action" value="compare" class="add-to-compare"><i style="color:red;" class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
													<?php } else { ?>
														<button name="action" value="compare" class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
													<?php } ?>
													<button class="quick-view" disabled>
														<i class="fa fa-eye"></i>
														<div class="toolshow product-details">
															<h2 class="product-price">{{ $value->product_name }}</h2>
															<div>
																<?php $temp = explode("#", $value->description); ?>
																<table>
																	<tbody>
																		@foreach($temp as $v)
																		<tr>{{ $v }}</tr><br>
																		@endforeach
																	</tbody>
																</table>
															</div>
														</div>
													</button>
												</div>
											</form>
										<?php } else { ?>
											<form action="{{ url('/others/index/'.$value->product_id.'/'.$user->id) }}" method="get">
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
													<button class="quick-view" disabled>
														<i class="fa fa-eye"></i>
														<div class="toolshow product-details">
															<h2 class="product-price">{{ $value->product_name }}</h2>
															<div>
																<?php $temp = explode("#", $value->description); ?>
																<table>
																	<tbody>
																		@foreach($temp as $v)
																		<tr>{{ $v }}</tr><br>
																		@endforeach
																	</tbody>
																</table>
															</div>
														</div>
													</button>
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
								@endforeach
								<!-- /product -->
							</div>
							<div id="slick-nav-np{{ $manu->manu_id }}" class="products-slick-nav"></div>
						</div>
						<!-- /tab -->
						@endforeach
					</div>
				</div>
			</div>
			<!-- Products tab & slick -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- HOT DEAL SECTION -->
<div id="hot-deal" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<div class="hot-deal">
					<ul class="hot-deal-countdown">
						<li>
							<div>
								<h3>02</h3>
								<span>Days</span>
							</div>
						</li>
						<li>
							<div>
								<h3>10</h3>
								<span>Hours</span>
							</div>
						</li>
						<li>
							<div>
								<h3>34</h3>
								<span>Mins</span>
							</div>
						</li>
						<li>
							<div>
								<h3>60</h3>
								<span>Secs</span>
							</div>
						</li>
					</ul>
					<h2 class="text-uppercase">hot deal this week</h2>
					<p>New Collection Up to 50% OFF</p>
					<a class="primary-btn cta-btn" href="#">Shop now</a>
				</div>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /HOT DEAL SECTION -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">Top selling</h3>
					<div class="section-nav">
						<ul class="section-tab-nav tab-nav">
							<li class="active"><a data-toggle="tab" href="#ts">Alls</a></li>
							@foreach($allmanus as $value)
							<li><a data-toggle="tab" href="#ts{{ $value->manu_id }}">{{ $value->manu_name }}</a></li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
			<!-- /section title -->
			<!-- Products tab & slick -->
			<div class="col-md-12">
				<div class="row">
					<div class="products-tabs">
						<!-- tab -->
						<div id="ts" class="tab-pane active">
							<div class="products-slick" data-nav="#slick-nav-ts">
								<!-- product -->
								@foreach($topsellings as $value)
								<div class="product">
									<div class="product-img">
										<a href="{{ url('/products/'.$value->product_id.'/'.$value->manu_id) }}"><img src="{{ asset('img/'.$value->image) }}" alt=""></a>
										<?php if ($value->sale > 0) { ?>
											<div class="product-label">
												<span class="sale">{{ "-".$value->sale."%" }}</span>
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
											<form action="{{ url('/others/index/'.$value->product_id.'/0') }}" method="get">
												<div class="product-btns">
													<button name="action" value="wishlist" class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
													<?php if (session()->has('compare' . $value->product_id)) { ?>
														<button name="action" value="compare" class="add-to-compare"><i style="color:red;" class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
													<?php } else { ?>
														<button name="action" value="compare" class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
													<?php } ?>
													<button class="quick-view" disabled>
														<i class="fa fa-eye"></i>
														<div class="toolshow product-details">
															<h2 class="product-price">{{ $value->product_name }}</h2>
															<div>
																<?php $temp = explode("#", $value->description); ?>
																<table>
																	<tbody>
																		@foreach($temp as $v)
																		<tr>{{ $v }}</tr><br>
																		@endforeach
																	</tbody>
																</table>
															</div>
														</div>
													</button>
												</div>
											</form>
										<?php } else { ?>
											<form action="{{ url('/others/index/'.$value->product_id.'/'.$user->id) }}" method="get">
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
													<button class="quick-view" disabled>
														<i class="fa fa-eye"></i>
														<div class="toolshow product-details">
															<h2 class="product-price">{{ $value->product_name }}</h2>
															<div>
																<?php $temp = explode("#", $value->description); ?>
																<table>
																	<tbody>
																		@foreach($temp as $v)
																		<tr>{{ $v }}</tr><br>
																		@endforeach
																	</tbody>
																</table>
															</div>
														</div>
													</button>
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
								@endforeach
								<!-- /product -->
							</div>
							<div id="slick-nav-ts" class="products-slick-nav"></div>
						</div>
						<!-- /tab -->
						@foreach($allmanus as $manu)
						<!-- tab -->
						<div id="ts{{ $manu->manu_id }}" class="tab-pane">
							<div class="products-slick" data-nav="#slick-nav-ts{{ $manu->manu_id }}">
								<!-- product -->
								@foreach(${'topselling'.$manu->manu_id} as $value)
								<div class="product">
									<div class="product-img">
										<a href="{{ url('/products/'.$value->product_id.'/'.$value->manu_id) }}"><img src="{{ asset('img/'.$value->image) }}" alt=""></a>
										<?php if ($value->sale > 0) { ?>
											<div class="product-label">
												<span class="sale">{{ "-".$value->sale."%" }}</span>
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
											<form action="{{ url('/others/index/'.$value->product_id.'/0') }}" method="get">
												<div class="product-btns">
													<button name="action" value="wishlist" class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
													<?php if (session()->has('compare' . $value->product_id)) { ?>
														<button name="action" value="compare" class="add-to-compare"><i style="color:red;" class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
													<?php } else { ?>
														<button name="action" value="compare" class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
													<?php } ?>
													<button class="quick-view" disabled>
														<i class="fa fa-eye"></i>
														<div class="toolshow product-details">
															<h2 class="product-price">{{ $value->product_name }}</h2>
															<div>
																<?php $temp = explode("#", $value->description); ?>
																<table>
																	<tbody>
																		@foreach($temp as $v)
																		<tr>{{ $v }}</tr><br>
																		@endforeach
																	</tbody>
																</table>
															</div>
														</div>
													</button>
												</div>
											</form>
										<?php } else { ?>
											<form action="{{ url('/others/index/'.$value->product_id.'/'.$user->id) }}" method="get">
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
													<button class="quick-view" disabled>
														<i class="fa fa-eye"></i>
														<div class="toolshow product-details">
															<h2 class="product-price">{{ $value->product_name }}</h2>
															<div>
																<?php $temp = explode("#", $value->description); ?>
																<table>
																	<tbody>
																		@foreach($temp as $v)
																		<tr>{{ $v }}</tr><br>
																		@endforeach
																	</tbody>
																</table>
															</div>
														</div>
													</button>
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
								@endforeach
								<!-- /product -->
							</div>
							<div id="slick-nav-ts{{ $manu->manu_id }}" class="products-slick-nav"></div>
						</div>
						<!-- /tab -->
						@endforeach
					</div>
				</div>
			</div>
			<!-- /Products tab & slick -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<?php for ($i = 0; $i < 3; $i++) { ?>
				<div class="col-md-4 col-xs-6">
					<div class="section-title">
						<h4 class="title">Top selling <?php echo $allmanus[$i]->manu_name ?></h4>
						<div class="section-nav">
							<div id="slick-nav-sl{{ $i }}" class="products-slick-nav"></div>
						</div>
					</div>
					<div class="products-widget-slick" data-nav="#slick-nav-sl{{ $i }}">
						@foreach(${'topselling'.$i + 1} as $value)
						<!-- product widget -->
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
						<!-- /product widget -->
						@endforeach
					</div>
				</div>
			<?php } ?>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

@endsection