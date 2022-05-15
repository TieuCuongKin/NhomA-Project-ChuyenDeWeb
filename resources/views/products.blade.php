@extends('layout')
@section('main-content')

<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<h3 class="breadcrumb-header">Details product</h3>
				<ul class="breadcrumb-tree">
					<li><a href="{{ url('/') }}">Home</a></li>
					<li class="active">Details product</li>
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
			<!-- Product main img -->
			<div class="col-md-5 col-md-push-2">
				<div id="product-main-img">
					<div class="product-preview">
						<img src="{{ asset('/img/'.$product->image) }}" alt="">
					</div>
				</div>
			</div>
			<!-- /Product main img -->

			<!-- Product thumb imgs -->
			<div class="col-md-2  col-md-pull-5">
				<div id="product-imgs">
					<div class="product-preview">
						<img src="{{ asset('/img/'.$product->image) }}" alt="">
					</div>
				</div>
			</div>
			<!-- /Product thumb imgs -->

			<!-- Product details -->
			<div class="col-md-5">
				<div class="product-details">
					<h2 class="product-name">{{ $product->product_name }}</h2>
					<div>
						<div class="product-rating">
							<?php for ($i = 0; $i < 5; $i++) {
								if ($i < $product->star) { ?>
									<i class="fa fa-star"></i>
								<?php } else { ?>
									<i class="fa fa-star-o"></i>
							<?php }
							} ?>
						</div>
						<a class="review-link" href="#">10 Review(s) | Add your review</a>
					</div>
					<div>
						<?php if ($product->sale > 0) { ?>
							<h3 class="product-price">{{ number_format($product->price - ($product->price * $product->sale / 100)) . "đ " }}<del class="product-old-price">{{ number_format($product->price)."đ" }}</del></h3>
							<span class="product-available">In Stock</span>
						<?php } else { ?>
							<h3 class="product-price">{{ number_format($product->price)."đ" }}</h3>
							<span class="product-available">In Stock</span>
						<?php } ?>
					</div>
					<div>
						<?php $temp = explode("#", $product->description); ?>
						<table>
							<tbody>
								@foreach($temp as $value)
								<tr>{{ $value }}</tr><br>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="product-options">
						<label>
							Size
							<select class="input-select">
								<option value="0">X</option>
							</select>
						</label>
						<label>
							Color
							<select class="input-select">
								<option value="0">Red</option>
							</select>
						</label>
					</div>
					<form action="{{ url('/carts/add/'.$product->product_id) }}" method="get">
						<div class="add-to-cart">
							<div class="qty-label">
								Qty
								<div class="input-number">
									<input type="number" name="quantity" value="1">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
							</div>
							<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
						</div>
					</form>

					<ul class="product-btns">
						<li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
						<li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
					</ul>

					<ul class="product-links">
						<li>Share:</li>
						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="#"><i class="fa fa-envelope"></i></a></li>
					</ul>

				</div>
			</div>
			<!-- /Product details -->

			<!-- Product tab -->
			<div class="col-md-12">
				<div id="product-tab">
					<!-- product tab nav -->
					<ul class="tab-nav">
						<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
						<li><a data-toggle="tab" href="#tab2">Details</a></li>
						<li><a data-toggle="tab" href="#tab3">Reviews (
								<?php $count = 0;
								foreach ($others as $value) {
									if ($value->product_id == $product->product_id && $value->submit != NULL) {
										$count++;
									}
								}
								echo $count; ?>
								)</a></li>
					</ul>
					<!-- /product tab nav -->

					<!-- product tab content -->
					<div class="tab-content">
						<!-- tab1  -->
						<div id="tab1" class="tab-pane fade in active">
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered">
										<thead>
											<tr>
												@foreach($temp as $value)
												<?php $temp1 = explode(":", $value); ?>
												<th style="text-align: center; vertical-align: middle">{{ $temp1[0] }}</th>
												@endforeach
											</tr>
										</thead>
										<tbody>
											<tr>
												@foreach($temp as $value)
												<?php $temp1 = explode(":", $value); ?>
												<td style="text-align: center; vertical-align: middle">{{ $temp1[1] }}</td>
												@endforeach
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- /tab1  -->

						<!-- tab2  -->
						<div id="tab2" class="tab-pane fade in">
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th style="text-align: center; vertical-align: middle">Manufacturers</th>
												<th style="text-align: center; vertical-align: middle">Star Users</th>
												<th style="text-align: center; vertical-align: middle">Like</th>
												<th style="text-align: center; vertical-align: middle">Comment</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td style="text-align: center; vertical-align: middle">{{ $product->manufacturers->manu_name }}</td>
												<td style="text-align: center; vertical-align: middle">
													<?php $totalstar = 0;
													$sumstar = 1;
													foreach ($others as $value) {
														if ($value->product_id == $product->product_id && $value->star != NULL) {
															$totalstar += (int)$value->star;
															$sumstar++;
														}
													}
													if (round($totalstar / $sumstar, 1) > 0) {
														echo round($totalstar / $sumstar, 1);
													} else {
														echo $product->star;
													}
													?>
												</td>
												<td style="text-align: center; vertical-align: middle">
													<?php $totallike = 0;
													foreach ($others as $value) {
														if ($value->product_id == $product->product_id && $value->like != NULL) {
															$totallike++;
														}
													}
													echo $totallike;
													?>
												</td>
												<td style="text-align: center; vertical-align: middle">
													<?php $totalcomment = 0;
													foreach ($others as $value) {
														if ($value->product_id == $product->product_id && $value->submit != NULL) {
															$totalcomment++;
														}
													}
													echo $totalcomment;
													?>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- /tab2  -->

						<!-- tab3  -->
						<div id="tab3" class="tab-pane fade in">
							<div class="row">
								<!-- Rating -->
								<div class="col-md-3">
									<div id="rating">
										<div class="rating-avg">
											<span>
												<?php $totalstar = 0;
												$sum = 1;
												$star1 = 0;
												$star2 = 0;
												$star3 = 0;
												$star4 = 0;
												$star5 = 0;
												foreach ($others as $value) {
													if ($value->product_id == $product->product_id && $value->star != NULL) {
														$totalstar += (int)$value->star;
														$sum++;
														if ($value->star == "1") {
															$star1++;
														}
														if ($value->star == "2") {
															$star2++;
														}
														if ($value->star == "3") {
															$star3++;
														}
														if ($value->star == "4") {
															$star4++;
														}
														if ($value->star == "5") {
															$star5++;
														}
													}
												}
												echo round($totalstar / $sum, 1) ?>
											</span>
											<div class="rating-stars">
												<?php for ($i = 0; $i < 5; $i++) {
													if ($i < ($totalstar / $sum)) { ?>
														<i class="fa fa-star"></i>
													<?php } else { ?>
														<i class="fa fa-star-o"></i>
												<?php }
												} ?>
											</div>
										</div>
										<ul class="rating">
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<div class="rating-progress">
													<div style="width: 80%;"></div>
												</div>
												<span class="sum">{{ $star5 }}</span>
											</li>
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<div class="rating-progress">
													<div style="width: 60%;"></div>
												</div>
												<span class="sum">{{ $star4 }}</span>
											</li>
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<div class="rating-progress">
													<div></div>
												</div>
												<span class="sum">{{ $star3 }}</span>
											</li>
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<div class="rating-progress">
													<div></div>
												</div>
												<span class="sum">{{ $star2 }}</span>
											</li>
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<div class="rating-progress">
													<div></div>
												</div>
												<span class="sum">{{ $star1 }}</span>
											</li>
										</ul>
									</div>
								</div>
								<!-- /Rating -->

								<!-- Reviews -->
								<div class="col-md-6">
									<div id="reviews">
										<ul class="reviews">
											<?php foreach ($others as $value) {
												if ($value->user_id == "0") {
													$guest = explode("#", $value->submit); ?>
													<li>
														<div class="review-heading">
															<h5 class="name">{{ $guest[0] }}
																<p style="font-size: 7px;">{{ '('.$guest[1].')'}}</p>
															</h5>
															<p class="date">{{ date('d/m/Y h:i:s', strtotime($value->created_at)) }}</p>
															<div class="review-rating">
																<?php for ($i = 0; $i < 5; $i++) {
																	if ($i < $value->star) { ?>
																		<i class="fa fa-star"></i>
																	<?php } else { ?>
																		<i class="fa fa-star-o empty"></i>
																<?php }
																} ?>
															</div>
														</div>
														<div class="review-body">
															<p>{{ $guest[2] }}</p>
														</div>
													</li>
												<?php } else { ?>
													<li>
														<div class="review-heading">
															<h5 class="name">{{ $value->users->name }}</h5>
															<p class="date">{{ date('d/m/Y h:i:s', strtotime($value->created_at)) }}</p>
															<div class="review-rating">
																<?php for ($i = 0; $i < 5; $i++) {
																	if ($i < $value->star) { ?>
																		<i class="fa fa-star"></i>
																	<?php } else { ?>
																		<i class="fa fa-star-o empty"></i>
																<?php }
																} ?>
															</div>
														</div>
														<div class="review-body">
															<p>{{ $value->submit }}</p>
														</div>
													</li>
											<?php }
											} ?>
										</ul>
										<ul>
											{{ $others->appends(request()->all())->links() }}
										</ul>
									</div>
								</div>
								<!-- /Reviews -->

								<!-- Review Form -->
								<div class="col-md-3">
									<div id="review-form">
										<?php if ($user != NULL) { ?>
											<form action="{{ url('/star/'.$product->manu_id.'/'.$product->product_id.'/'.$user->id) }}" class="review-form" method="GET">
												<textarea name="submit" class="input" placeholder="Your Review" required></textarea>
												<div class="input-rating">
													<span>Your Rating: </span>
													<div class="stars">
														<input id="star5" name="rating" value="5" type="radio" required><label for="star5"></label>
														<input id="star4" name="rating" value="4" type="radio" required><label for="star4"></label>
														<input id="star3" name="rating" value="3" type="radio" required><label for="star3"></label>
														<input id="star2" name="rating" value="2" type="radio" required><label for="star2"></label>
														<input id="star1" name="rating" value="1" type="radio" required><label for="star1"></label>
													</div>
												</div>
												<button class="primary-btn">Submit</button>
											</form>
										<?php } else { ?>
											<form action="{{ url('/star/'.$product->manu_id.'/'.$product->product_id.'/0') }}" class="review-form" method="GET">
												<input class="input" name="name" type="text" placeholder="Your Name" required>
												<input class="input" name="email" type="email" placeholder="Your Email" required>
												<textarea class="input" name="submit" placeholder="Your Review" required></textarea>
												<div class="input-rating">
													<span>Your Rating: </span>
													<div class="stars">
														<input id="star5" name="rating" value="5" type="radio" required><label for="star5"></label>
														<input id="star4" name="rating" value="4" type="radio" required><label for="star4"></label>
														<input id="star3" name="rating" value="3" type="radio" required><label for="star3"></label>
														<input id="star2" name="rating" value="2" type="radio" required><label for="star2"></label>
														<input id="star1" name="rating" value="1" type="radio" required><label for="star1"></label>
													</div>
												</div>
												<button class="primary-btn">Submit</button>
											</form>
										<?php } ?>
									</div>
								</div>
								<!-- /Review Form -->
							</div>
						</div>
						<!-- /tab3  -->
					</div>
					<!-- /product tab content  -->
				</div>
			</div>
			<!-- /product tab -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- Section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<div class="section-title text-center">
					<h3 class="title">Related Products</h3>
				</div>
			</div>
			<?php for ($i = 0, $k = 0; $i < count($productManus) && $k < 4; $i++) {
				if ($productManus[$i]->product_id != $product->product_id) {
					$k++ ?>
					<!-- product -->
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<div class="product-img">
								<a href="{{ url('/products/'.$productManus[$i]->product_id.'/'.$productManus[$i]->manu_id) }}"><img src="{{ asset('img/'.$productManus[$i]->image) }}" alt=""></a>
								<?php if ($productManus[$i]->sale > 0) { ?>
									<div class="product-label">
										<span class="sale">{{ "-".$productManus[$i]->sale."%" }}</span>
									</div>
								<?php } else { ?>
									<div class="product-label">
										<span class="new">NEW</span>
									</div>
								<?php } ?>
							</div>
							<div class="product-body">
								<p class="product-category">{{ $productManus[$i]->manufacturers->manu_name }}</p>
								<h3 class="product-name"><a href="{{ url('/products/'.$productManus[$i]->product_id.'/'.$productManus[$i]->manu_id) }}">{{ $productManus[$i]->product_name }}</a></h3>
								<?php if ($productManus[$i]->sale > 0) { ?>
									<h4 class="product-price">{{ number_format($productManus[$i]->price - ($productManus[$i]->price * $productManus[$i]->sale / 100)) . "đ " }}<del class="product-old-price">{{ number_format($productManus[$i]->price)."đ" }}</del></h4>
								<?php } else { ?>
									<h4 class="product-price">{{ number_format($productManus[$i]->price)."đ" }}</h4>
								<?php } ?>
								<div class="product-rating">
									<?php for ($j = 0; $j < 5; $j++) {
										if ($j < $productManus[$i]->star) { ?>
											<i class="fa fa-star"></i>
										<?php } else { ?>
											<i class="fa fa-star-o"></i>
									<?php }
									} ?>
								</div>
								<?php if ($user == NULL) { ?>
									<form action="{{ url('/others/index/'.$productManus[$i]->product_id.'/0') }}" method="get">
										<div class="product-btns">
											<button name="action" value="wishlist" class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
											<?php if (session()->has('compare' . $productManus[$i]->product_id)) { ?>
												<button name="action" value="compare" class="add-to-compare"><i style="color:red;" class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
											<?php } else { ?>
												<button name="action" value="compare" class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
											<?php } ?>
											<button name="action" value="view" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
										</div>
									</form>
								<?php } else { ?>
									<form action="{{ url('/others/index/'.$productManus[$i]->product_id.'/'.$user->id) }}" method="get">
										<div class="product-btns">
											<?php $like = 0;
											foreach ($user->others as $other) {
												if ($other->product_id == $productManus[$i]->product_id && $other->like == "1") {
													$like = 1; ?>
													<button name="action" value="wishlist" class="add-to-wishlist"><i style="color:red;" class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
												<?php }
											}
											if ($like == 0) { ?>
											<?php }
											if (session()->has('compare' . $productManus[$i]->product_id)) { ?>
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
								<a href="{{ url('/carts/add/'.$productManus[$i]->product_id) }}">
									<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
								</a>
							</div>
						</div>
					</div>
					<!-- /product -->
			<?php }
			} ?>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /Section -->

@endsection