@extends('layout')
@section('content')

	<!-- SECTION -->
		<div class="section mt-5">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
				@if(session()->has('success'))
					<div class="alert alert-success d-flex align-items-center mt-3" role="alert">
					<div>
						<strong><i class="fa-solid fa-check"></i></strong>  {{ session()->get('success') }}
					</div>
					</div>
					@endif
					<div class="col-md-7">
						<form action="" >
					
						<!-- Billing Details -->
						<div class="row billing-details">
							<div class="mb-3">
								<h3 class="title">Thông tin cá nhân</h3>
							</div>
							<div class="col-8 mb-3">
								<label for="name" class="form-label">Họ và tên</label>
								<input class="form-control" type="text" id="name" name="full_name" placeholder="Your Name" value="{{ Auth::guard('cus')->user()->full_name }}">
								@if($errors->has('full_name'))
                                    <p style="color:red"> {{$errors->first('full_name') }} !!!</p>
                                @endif
							</div>
							<div class="col-8 mb-3">
								<label for="email" class="form-label">Địa chỉ Email</label>
								<input class="form-control" type="email" id="email" name="email" placeholder="exam@email.com" value="{{ Auth::guard('cus')->user()->email }}" readonly>
							</div>
							<div class="col-8 mb-3">
								<label for="address" class="form-label">Địa chỉ</label>
								<input class="form-control" type="text" name="address" placeholder="Your Address" value="{{ Auth::guard('cus')->user()->address }}">
								@if($errors->has('address'))
                                    <p style="color:red"> {{$errors->first('address') }} !!!</p>
                                @endif
							</div>
							<div class="col-8 mb-3">
								<label for="phone" class="form-label">Số điện thoại</label>
								<input class="form-control" type="tel" name="phone" placeholder="Telephone" value="{{ Auth::guard('cus')->user()->phone }}">
								@if($errors->has('phone'))
                                    <p style="color:red"> {{$errors->first('phone') }} !!!</p>
                                @endif
							</div>
						</div>
						<button type="submit" class="btn btn-primary order-submit ">Cập nhật thông tin</button>
						</form>
						<!-- /Billing Details -->
					</div>

				
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
@endsection