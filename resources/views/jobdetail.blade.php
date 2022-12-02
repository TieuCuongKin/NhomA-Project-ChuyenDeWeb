@extends('layout')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container-fluid about py-5">
        <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
            <h2 class="text-primary font-secondary">Detail</h2>
            <h2 class="product-name">{{ $jobdetail->job_title }}</h2>
        </div>
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- Order Details -->
                <div class="col-md order-details">
                    <div class="order-summary">
                        <div class="order-col">
                            <div><strong> Công ty:</strong></div>
                            <div>
                                <h5 class="text-primary">{{$jobdetail->company->company_name}}</h5>
                            </div>
                        </div>
                        <div class="order-products">
                            <div class="order-col">
                                <div><strong>Địa chỉ:</strong></div>
                                <h5 class="text-primary">{{ $jobdetail ->location->location_name  }}</h5>
                            </div>
                        </div>
                        <div class="order-col">
                            <div><strong>Lương:</strong></div>
                            <div>
                                <h5 class="text-primary">{{ number_format($jobdetail -> job_salary_max,0,',','.')  }} VND</h5>
                            </div>
                        </div>
                        <div class="order-col">
                            <div><strong>Thời gian hết hạn:</strong></div>
                            <div><span class="badge bg-primary"><strong>{{ $jobdetail ->job_expired_at  }}</strong></span> </div>
                        </div>
                        <div class="order-col">
                            <div><strong>Thời gian đăng:</strong></div>
                            <div><span class="badge bg-primary"><strong>{{ $jobdetail ->created_at  }}</strong></span> </div>
                        </div>
                    </div>
                </div>
                <div class="order-col">
                    <div><strong>Mô tả:</strong></div>
                    <p><?php echo $jobdetail->job_description ?></p>
                </div>
            </div>
            <div class="order-col">
                <div><strong>Đánh giá</strong></div>
                <div>
                    <ul class="list-inline ngoisao" title="Average Rating">
                        @for ($count=1; $count <= 5; $count++) @php if($count<=$sosao){ $color='color:#ffcc00;' ; } else{ $color='color:#ccc;' ; } @endphp <li title="star_rating" class="ngoisao" style="display: inline-block;cusor:pointer; {{$color}};font-size:30px;">&#9733;</li>
                            @endfor
                    </ul>
                </div>
                <!-- /Order Details -->
                <div class="owl-carousel testimonial-carousel">
                    <div class="testimonial-item text-white border-inner p-4">
                        <div class="align-items-center mb-3">
                            @if(Auth::guard('cus')->check())
                            <h4 class="text-primary text-uppercase mb-1">{{ Auth::guard('cus')->user()->full_name }}</h4>
                            <input type="hidden" class="form-control" id="customer_id" name="customer_id" value="{{Auth::guard('cus')->user()->id}}">
                            <input type="hidden" class="form-control" id="customer_name" name="customer_name" value="{{Auth::guard('cus')->user()->full_name}}">
                            @else
                            <h4 class="text-primary text-uppercase mb-1">Tài khoản khách</h4>
                            @endif
                            <textarea type="text" class="form-control" id="comment_content" name="comment_content" cols="auto" rows="3" placeholder="Nhập nội dung (*)" required></textarea>
                            <div id="commentHelp" class="form-text mb-3"></div>
                            <input type="hidden" class="form-control" id="id" name="id" value="{{ $jobdetail->id }}">
                            @if(Auth::guard('cus')->check())
                            
                            <button id="btn-comment" type="button" class="btn btn-primary" data-product-id="{{ $jobdetail->id }}" data-url="{{ route('comments.store') }}">Gửi bình luận</button>
                            @else
                            <button class="btn btn-primary" type="button" disabled>Gửi bình luận</button>
                            @endif
                        </div>
                    </div>
                    <div id="show-comment" class="overflow-auto" style="max-height:300px; ">
                        @foreach($comments as $comment)
                        <div class="testimonial-item text-white border-inner p-4" style="background-color:#905ddc !important">
                            <div class="d-flex align-items-center mb-3">
                                <img class="img-fluid flex-shrink-0" src="{{url('/img/smile.png')}}" style="width: 60px; height: 60px;">
                                <div class="ps-3">
                                    <h4 class="text-white text-uppercase mb-1">{{$comment->customer_name}}</h4>
                                    <span>{{$comment->rating}} Sao</span>
                                </div>
                            </div>
                            <p class="mb-0">{{$comment->comment_content}}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- /SECTION -->


            @endsection