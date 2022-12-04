<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Electro - HTML Ecommerce Template</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href='{{ asset("css/bootstrap.min.css") }}' />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="{{ asset('css/slick.css') }}" />
	<link type="text/css" rel="stylesheet" href="{{ asset('css/slick-theme.css') }}" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="{{ asset('css/nouislider.min.css') }}" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
	<!-- HEADER -->
	<header>
		<!-- TOP HEADER -->
		<div id="top-header">
			<div class="container">
				<ul class="header-links pull-left">
					<li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
					<li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
					<li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
				</ul>
				<ul class="header-links pull-right">
					<?php if ($user != NULL) {
						if ($user->name == "admin") { ?>
							<li><a href="{{ url('/admin') }}"><i class="fa fa-user-o"></i>User {{ $user->name }}</a></li>
						<?php } else { ?>
							<li><a href="{{ url('/') }}"><i class="fa fa-user-o"></i>User {{ $user->name }}</a></li>
						<?php } ?>
						<li>
							<form method="POST" action="{{ route('logout') }}">
								@csrf
								<a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" style="text-align: center; color: aliceblue">{{ __('Log Out') }} <i class="fa fa-arrow-circle-right"></i></a>
							</form>
						</li>
					<?php } else { ?>
						<li><a href="{{ url('/login') }}"><i class="fa fa-user-o"></i>Login</a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<!-- /TOP HEADER -->

		<!-- MAIN HEADER -->
		<div id="header">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- LOGO -->
					<div class="col-md-2">
						<div class="header-logo">
							<a href="{{ url('/') }}" class="logo">
								<img src="{{ asset('/img/logo.png') }}" alt="">
							</a>
						</div>
					</div>
					<!-- /LOGO -->

					<!-- SEARCH BAR -->
					<div class="col-md-6">
						<div class="header-search">
							<form method="GET" action="{{ url('/search') }}">
								<select class="input-select" name="option">
									<option value="description">Description </option>
									<option value="product_name">Product name</option>
									<option value="manu_name">Manufacturers</option>
								</select>
								<input name="key" class="input" placeholder="Search here">
								<button class="search-btn">Search</button>
							</form>
						</div>
					</div>
					<!-- /SEARCH BAR -->

					<!-- ACCOUNT -->
					<div class="col-md-4 clearfix">
						<div class="header-ctn">
							<?php if ($user != NULL) { ?>
								<!-- Wishlist -->
								<div>
									<a href="{{ url('/search?option=wishlist') }}">
										<i class="fa fa-heart-o"></i>
										<span>Your Wishlist</span>
										<div class="qty">
											{{ count($allothers); }}
										</div>
									</a>
								</div>
								<!-- /Wishlist -->

								<!-- PayMents -->
								<div class="dropdown">
									<a href="{{ url('/payments') }}">
										<i class="fa fa-heart-o"></i>
										<span>Payments</span>
										<div class="qty">
											{{ count($allpayments); }}
										</div>
									</a>
								</div>
								<!-- /PayMents -->
							<?php } ?>

							<!-- Cart -->
							<div class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
									<i class="fa fa-shopping-cart"></i>
									<span>Your Cart</span>
									<div class="qty">
										<?php
										$total = 0;
										foreach ($allproducts as $value) {
											if (session()->has('carts' . $value->product_id)) {
												$total++;
											}
										}
										echo $total; ?>
									</div>
								</a>
								<div class="cart-dropdown">
									<div class="cart-list">
										<?php $sum = 0;
										foreach ($allproducts as $value) {
											if (session()->has('carts' . $value->product_id)) { ?>
												<div class="product-widget">
													<div class="product-img">
														<a href="{{ url('/products/'.$value->product_id.'/'.$value->manu_id) }}"><img src="{{ asset('img/'.$value->image) }}" alt=""></a>
													</div>
													<div class="product-body">
														<h3 class="product-name"><a href="{{ url('/products/'.$value->product_id.'/'.$value->manu_id) }}">{{ $value->product_name }}</a></h3>
														<h4 class="product-price"><span class="qty">{{ session()->get('carts' . $value->product_id) }} x</span>
															<?php if ($value->sale > 0) {
																$sum += ($value->price - ($value->price * $value->sale / 100)) * session()->get('carts' . $value->product_id);
																echo number_format($value->price - ($value->price * $value->sale / 100)) . "đ ";
															} else {
																$sum += $value->price * session()->get('carts' . $value->product_id);
																echo number_format($value->price) . "đ";
															} ?>
														</h4>
													</div>
													<a href="{{ url('/carts/delete/'.$value->product_id) }}" class="delete">
														<i class="fa fa-close"></i>
													</a>
												</div>
										<?php }
										} ?>
									</div>
									<div class="cart-summary">
										<small>{{ $total }} Item(s) selected</small>
										<h5>SUBTOTAL: {{ number_format($sum) . "đ" }}</h5>
									</div>
									<div class="cart-btns">
										<a href="{{ url('/carts') }}">View Cart</a>
										<a href="{{ url('/checkout') }}">Checkout <i class="fa fa-arrow-circle-right"></i></a>
									</div>
								</div>
							</div>
							<!-- /Cart -->

							<!-- Menu Toogle -->
							<div class="menu-toggle">
								<a href="#">
									<i class="fa fa-bars"></i>
									<span>Menu</span>
								</a>
							</div>
							<!-- /Menu Toogle -->
						</div>
					</div>
					<!-- /ACCOUNT -->
				</div>
				<!-- row -->
			</div>
			<!-- container -->
		</div>
		<!-- /MAIN HEADER -->
	</header>
	<!-- /HEADER -->

	<!-- NAVIGATION -->
	<nav id="navigation">
		<!-- container -->
		<div class="container">
			<!-- responsive-nav -->
			<div id="responsive-nav">
				<!-- NAV -->
				<ul class="main-nav nav navbar-nav">
					<li class="active"><a href="{{ url('/') }}">Home</a></li>
					<li><a href="{{ url('/search?option=alls') }}">Alls</a></li>
					@foreach($allmanus as $value)
					<li><a href="{{ url('/search?option=manu_name&key='.$value->manu_name) }}">{{ $value->manu_name }}</a></li>
					@endforeach
				</ul>
				<!-- /NAV -->
			</div>
			<!-- /responsive-nav -->
		</div>
		<!-- /container -->
	</nav>
	<!-- /NAVIGATION -->

	@yield('main-content')

	<!-- NEWSLETTER -->
	<div id="newsletter" class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-12">
					<div class="newsletter">
						<p>Sign Up for the <strong>NEWSLETTER</strong></p>
						<form action="{{ url('/mail') }}" method="GET">
							<input class="input" name="mail" type="email" placeholder="Enter Your Email">
							<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
						</form>
						<ul class="newsletter-follow">
							<li>
								<a href="#"><i class="fa fa-facebook"></i></a>
							</li>
							<li>
								<a href="#"><i class="fa fa-twitter"></i></a>
							</li>
							<li>
								<a href="#"><i class="fa fa-instagram"></i></a>
							</li>
							<li>
								<a href="#"><i class="fa fa-pinterest"></i></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /NEWSLETTER -->

	<!-- FOOTER -->
	<footer id="footer">
		<!-- top footer -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-3 col-xs-6">
						<div class="footer">
							<h3 class="footer-title">About Us</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
							<ul class="footer-links">
								<li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
								<li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
								<li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-3 col-xs-6">
						<div class="footer">
							<h3 class="footer-title">Categories</h3>
							<ul class="footer-links">
								@foreach($allmanus as $value)
								<li><a href="{{ url('/store/'.$value->manu_id) }}">{{ $value->manu_name }}</a></li>
								@endforeach
							</ul>
						</div>
					</div>

					<div class="clearfix visible-xs"></div>

					<div class="col-md-3 col-xs-6">
						<div class="footer">
							<h3 class="footer-title">Information</h3>
							<ul class="footer-links">
								<li><a href="#">About Us</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Privacy Policy</a></li>
								<li><a href="#">Orders and Returns</a></li>
								<li><a href="#">Terms & Conditions</a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-3 col-xs-6">
						<div class="footer">
							<h3 class="footer-title">Service</h3>
							<ul class="footer-links">
								<li><a href="#">My Account</a></li>
								<li><a href="#">View Cart</a></li>
								<li><a href="#">Wishlist</a></li>
								<li><a href="#">Track My Order</a></li>
								<li><a href="#">Help</a></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /top footer -->

		<!-- bottom footer -->
		<div id="bottom-footer" class="section">
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12 text-center">
						<ul class="footer-payments">
							<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
							<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
							<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
							<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
							<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
							<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
						</ul>
						<span class="copyright">
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							Copyright &copy;<script>
								document.write(new Date().getFullYear());
							</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						</span>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /bottom footer -->
	</footer>
	<!-- /FOOTER -->

	<!-- jQuery Plugins -->
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/slick.min.js') }}"></script>
	<script src="{{ asset('js/nouislider.min.js') }}"></script>
	<script src="{{ asset('js/jquery.zoom.min.js') }}"></script>
	<script src="{{ asset('js/main.js') }}"></script>

</body>

</html>