@extends('layout')
@section('content')
  <!-- Header End -->
  <div class="container-xxl py-5 bg-dark page-header mb-5">
            <div class="container my-5 pt-5 pb-4">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Company</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Company</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Header End -->

      
                <!-- Category Start -->

                <div class="container-xxl py-5">
                    <div class="container">
                        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Company List</h1>
                        <div class="row g-4">
                            @foreach($company as $value)
                            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                                <a class="cat-item rounded p-4" href="">
                                    <i class="fa fa-3x fa-mail-bulk text-primary mb-4"></i>
                                    <li><a data-toggle="tab" href="#np{{ $value->company_id }}">{{ $value->company_name }}</a></li>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Category End -->


@endsection