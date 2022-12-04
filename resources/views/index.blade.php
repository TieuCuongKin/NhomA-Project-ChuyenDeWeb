@extends('layout')
@section('main-content')

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">Jobs Hot</h3>
					<div class="section-nav">
						<ul class="section-tab-nav tab-nav">
							<li class="active"><a data-toggle="tab" href="#np">Alls</a></li>
							@foreach($allmanus as $value)
							<li><a data-toggle="tab" href="{{ $value->company_id }}">{{ $value->company_name }}</a></li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- /section title -->
		<!-- Products tab & slick -->
		<div class="col-md-12">
			<div class="row">
				<!-- tab -->
				<div id="np" class="tab-pane active">
					<div class="products-slick" data-nav="#slick-nav-np">
						<!-- product -->
						@foreach($newproducts as $value)
						<div class="product">
							<div class="product-img">
								<a href="{{ url('/products/'.$value->product_id.'/'.$value->user_id) }}"><img src="{{ asset('img/'.$value->image) }}" alt=""></a>
							</div>
							<div class="product-body">
								<p class="product-category">{{ $value->company_name }}</p>
								<h3 class="product-name"><a href="{{ url('/products/'.$value->product_id.'/'.$value->company_id) }}">{{ $value->product_name }}</a></h3>

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
									<button class="add-to-cart-btn"><i class="fad fa-wifi"></i> Apply Jobs</button>
								</a>
							</div>
						</div>
						@endforeach
						<!-- /product -->
					</div>
					<div id="slick-nav-np" class="products-slick-nav"></div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<br><br><br>
<hr>
<!-- /tab -->
<div class="col-md-12">
	<div class="section-title-1">
		<h3 class="title">Company</h3>


	</div>
</div>
</div>

<!-- tab -->
		<div class="row g-4">
			@foreach($allmanus as $value)

			<div class="col-md-2 col-sm-4 feature-job job-ta">
				<hr>
				<a class="cat-item rounded p-2" href="">
					<h5 data-toggle="tab" href="#np{{ $value->id }}">Tên:{{ $value->company_name }}</h5>
					<br>
					<a>Địa chỉ:{{ $value->company_address }}</a>
					<br>
					<br>
					<a>Website:{{ $value->company_website }}</a>
					<br>
					<br>
					<a>Contact:{{ $value->company_contact }}</a>
				</a>
				<hr>
			</div>
			@endforeach
		</div>
	</div>
	<!-- Category End -->
	<!-- Testimonial Start -->
	<br>
	<br>
	<br>
	<br>
	<hr>
	<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
		<div class="container">
			<h3 class="text-center mb-5">Our Clients Say!!!</h3>
			<div class="owl-carousel testimonial-carousel">
				<div class="testimonial-item bg-light rounded p-4">
					<i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
					<p>Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam</p>
					<div class="d-flex align-items-center">
						<img class="img-fluid flex-shrink-0 rounded" src="img/testimonial-1.jpg" style="width: 50px; height: 50px;">
						<div class="ps-3">
							<h5 class="mb-1">Client Name</h5>
							<small>Profession</small>
						</div>
					</div>
				</div>
				<div class="testimonial-item bg-light rounded p-4">
					<i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
					<p>Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam</p>
					<div class="d-flex align-items-center">
						<img class="img-fluid flex-shrink-0 rounded" src="img/testimonial-2.jpg" style="width: 50px; height: 50px;">
						<div class="ps-3">
							<h5 class="mb-1">Client Name</h5>
							<small>Profession</small>
						</div>
					</div>
				</div>
				<div class="testimonial-item bg-light rounded p-4">
					<i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
					<p>Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam</p>
					<div class="d-flex align-items-center">
						<img class="img-fluid flex-shrink-0 rounded" src="img/testimonial-3.jpg" style="width: 50px; height: 50px;">
						<div class="ps-3">
							<h5 class="mb-1">Client Name</h5>
							<small>Profession</small>
						</div>
					</div>
				</div>
				<div class="testimonial-item bg-light rounded p-4">
					<i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
					<p>Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam</p>
					<div class="d-flex align-items-center">
						<img class="img-fluid flex-shrink-0 rounded" src="img/testimonial-4.jpg" style="width: 50px; height: 50px;">
						<div class="ps-3">
							<h5 class="mb-1">Client Name</h5>
							<small>Profession</small>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
<!-- Testimonial End -->
</div>
</div>
</div>
</div>
<!-- /SECTION -->


@endsection