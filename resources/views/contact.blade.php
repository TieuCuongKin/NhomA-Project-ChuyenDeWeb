@extends('layout')
@section('content')
<?php $title='contact' ?>

    <!-- Page Header Start -->
    <div class="container-fluid bg-dark bg-img p-5 mb-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-uppercase text-white">Liên Hệ Với Chúng Tôi</h1>
                <a href="/">Home</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="">Liên Hệ</a>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
    @if(session()->has('success'))
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div>
                {{ session()->get('success') }}
            </div>
    </div>
    @endif

    <!-- Contact Start -->
    <div class="container-fluid contact position-relative px-5" style="margin-top: 90px;">
        <div class="container">
            <div class="row g-5 mb-5">
                <div class="col-lg-4 col-md-6">
                    <div class="bg-primary border-inner text-center text-white p-5">
                        <i class="bi bi-geo-alt fs-1 text-white"></i>
                        <h6 class="text-uppercase my-2">Địa Chỉ</h6>
                        <span>TP.Thủ Đức, Việt Nam</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="bg-primary border-inner text-center text-white p-5">
                        <i class="bi bi-envelope-open fs-1 text-white"></i>
                        <h6 class="text-uppercase my-2">Email Us</h6>
                        <span>ntm748664@gmail.com</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="bg-primary border-inner text-center text-white p-5">
                        <i class="bi bi-phone-vibrate fs-1 text-white"></i>
                        <h6 class="text-uppercase my-2">Call Us</h6>
                        <span>+012 345 6789</span>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <form method="POST" action="">
                        @csrf
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <input type="text" name="name" class="form-control bg-light border-0 px-4" placeholder="Họ và tên" style="height: 55px;">
                            </div>
                            <div class="col-sm-6">
                                <input type="email" name="email" class="form-control bg-light border-0 px-4" placeholder="Địa chỉ email" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-12">
                                <input type="text" name="subject" class="form-control bg-light border-0 px-4" placeholder="Tiêu đề" style="height: 55px;">
                            </div>
                            <div class="col-sm-12">
                                <textarea name="content" class="form-control bg-light border-0 px-4 py-3" rows="4" placeholder="Nội dung"></textarea>
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary border-inner w-100 py-3" type="submit">Gửi tin nhắn</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
    
@endsection