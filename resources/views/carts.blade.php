@extends('layout')
@section('main-content')

<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<h3 class="breadcrumb-header">Cart</h3>
				<ul class="breadcrumb-tree">
					<li><a href="{{ url('/') }}">Home</a></li>
					<li class="active">Cart</li>
				</ul>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /BREADCRUMB -->

<main role="main">
	<!-- Block content - Đục lỗ trên giao diện bố cục chung, đặt tên là `content` -->
	<div class="container mt-4">
		<div class="row">
			<div class="col col-md-12">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th style="text-align: center; vertical-align: middle">STT</th>
							<th style="text-align: center; vertical-align: middle">Image</th>
							<th style="text-align: center; vertical-align: middle">Product Name</th>
							<th style="text-align: center; vertical-align: middle">Quantity</th>
							<th style="text-align: center; vertical-align: middle">Price</th>
							<th style="text-align: center; vertical-align: middle">Into Money</th>
							<th style="text-align: center; vertical-align: middle">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$stt = 1;
						$total = 0;
						foreach ($allproducts as $value) {
							if (session()->has('carts' . $value->product_id)) { ?>
								<tr>
									<td style="text-align: center; vertical-align: middle">
										<?php echo $stt;
										$stt++ ?>
									</td>
									<td style="text-align: center; padding-left: 25px">
										<div class="product-widget">
											<div class="product-img">
												<a href="{{ url('/products/'.$value->product_id.'/'.$value->manu_id) }}">
													<img src="{{ asset('img/'.$value->image) }}" alt="">
												</a>
											</div>
										</div>
									</td>
									<td style="text-align: center; vertical-align: middle">{{ $value->product_name }}</td>
									<td style="text-align: center; vertical-align: middle">
										<div style="text-align: center;">
											{{ session()->get('carts' . $value->product_id) }}<br>
											<a class="btn btn-danger " href="{{ url('/carts/+/'.$value->product_id) }}" class="plus">+</a>
											<a class="btn btn-danger " href="{{ url('/carts/-/'.$value->product_id) }}" class="plus">-</a>
										</div>
									</td>
									<td style="text-align: center; vertical-align: middle">
										<?php if ($value->sale > 0) {
											echo number_format($value->price - ($value->price * $value->sale / 100)) . "đ ";
										} else {
											echo number_format($value->price) . "đ";
										} ?>
									</td>
									<td style="text-align: center; vertical-align: middle">
										<?php if ($value->sale > 0) {
											$total += ($value->price - ($value->price * $value->sale / 100)) * session()->get('carts' . $value->product_id);
											echo number_format(($value->price - ($value->price * $value->sale / 100)) * session()->get('carts' . $value->product_id)). "đ ";
										} else {
											$total += ($value->price * session()->get('carts' . $value->product_id));
											echo number_format($value->price * session()->get('carts' . $value->product_id)) . "đ";
										} ?>
									</td>
									<td style="text-align: center; vertical-align: middle">
										<a href="{{ url('/carts/delete/'.$value->product_id) }}" data-sp-ma="2" class="btn btn-danger ">
											<i class="fa fa-trash" aria-hidden="true"></i> Xóa
										</a>
									</td>
								</tr>
						<?php
							}
						}
						?>
					</tbody>
				</table>
				<div class="row">
					<div class="col-md-6 text-left">
						<a href="{{ url('/') }}" class="btn btn-warning btn-md"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Back</a>
						<a href="{{ url('/checkout') }}" class="btn btn-primary btn-md"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Checkout</a>
					</div>
					<div class="col-md-6 text-right" >
						<h3>Total payment: <strong style="color: crimson">{{ number_format($total).' đ' }}</strong></3>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End block content -->
</main>

@endsection