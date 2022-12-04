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

					</div>
				</div>
			</div>
			<div class="product-details">
				<h2 class="product-name">{{ $product->product_name }}</h2>
				<div class="product-img">
					<img src="{{ asset('img/'.$product->image) }}" alt=""></a>
				</div>
				<div class="product-rating">
					<?php for ($i = 0; $i < 5; $i++) {
						if ($i < $product->star) { ?>
							<i class="fa fa-star"></i>
						<?php } else { ?>
							<i class="fa fa-star-o"></i>
					<?php }
					} ?>
				</div>
			</div>
			<a class="review-link" href="#">10 Review(s) | Add your review</a>
		</div>
		<?php $temp = explode("#", $product->description); ?>
		<table>
			<tbody>
				@foreach($temp as $value)
				<tr>{{ $value }}</tr><br>
				@endforeach
			</tbody>
		</table>
	</div>
	<!-- /Product details -->
	<!-- Product tab -->
	<div class="col-md-12">
		<div id="product-tab">
			<!-- product tab nav -->
			<ul class="tab-nav">
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
									<td style="text-align: center; vertical-align: middle">{{ $product->company_name }}</td>
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
												<h5 class="name">{{ $value->user_id}}</h5>
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
								<form action="{{ url('/star/'.$product->product_id.'/'.$user->id) }}" class="review-form" method="GET">
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
								<form action="{{ url('/star/'.$product->product_id.'/0') }}" class="review-form" method="GET">
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


@endsection