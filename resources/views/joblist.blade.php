 @extends('layout')
 @section('content')
 <!-- Header End -->
 <div class="container-xxl py-5 bg-dark page-header mb-5">
     <div class="container my-5 pt-5 pb-4">
         <h1 class="display-3 text-white mb-3 animated slideInDown">Job </h1>
         <nav aria-label="breadcrumb">
             <ol class="breadcrumb text-uppercase">
                 <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                 <li class="breadcrumb-item"><a href="#">Pages</a></li>
                 <li class="breadcrumb-item text-white active" aria-current="page">Job </li>
             </ol>
         </nav>
     </div>
 </div>
 <!-- Header End -->
 <!-- Jobs Start -->
 <div class="container-xxl py-5">
     <div class="container">
         <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Job Listing</h1>
         <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
             <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                 <div>
                     <li class="nav-item">
                         <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-2">
                             <h6 class="mt-n1 mb-0">Feature</h6>
                         </a>
                     </li>
                     @foreach($feature as $value)
                     <div class="tab-content">
                         <div id="tab-1" class="tab-pane fade show p-0 active">
                             <div class="job-item p-4 mb-4">
                                 <div class="row g-4">
                                     <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                         <img class="flex-shrink-0 img-fluid border rounded" src="img/com-logo-1.jpg" alt="" style="width: 80px; height: 80px;">
                                         <div class="text-start ps-4">

                                             <li><a data-toggle="tab" href="{{ $value->job_title }}">{{ $value->job_title }}</a></li>

                                         </div>
                                     </div>
                                     <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                         <div class="d-flex mb-3">
                                             <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
                                             <a class="btn btn-primary" href="">Apply Now</a>
                                         </div>
                                         <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: 01 Jan, 2045</small>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         @endforeach
                         <li class="nav-item">
                             <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-2">
                                 <h6 class="mt-n1 mb-0">Full Time</h6>
                             </a>
                         </li>
                         @foreach($fulltime as $value)
                         <div class="tab-content">
                             <div id="tab-1" class="tab-pane fade show p-0 active">
                                 <div class="job-item p-4 mb-4">
                                     <div class="row g-4">
                                         <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                             <img class="flex-shrink-0 img-fluid border rounded" src="img/com-logo-1.jpg" alt="" style="width: 80px; height: 80px;">
                                             <div class="text-start ps-4">

                                                 <li><a data-toggle="tab" href="#np{{ $value->job_type_id }}">{{ $value->job_title }}</a></li>

                                             </div>
                                         </div>
                                         <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                             <div class="d-flex mb-3">
                                                 <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
                                                 <a class="btn btn-primary" href="">Apply Now</a>
                                             </div>
                                             <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: 01 Jan, 2045</small>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             @endforeach
                             <li class="nav-item">
                                 <a class="d-flex align-items-center text-start mx-3 me-0 pb-3" data-bs-toggle="pill" href="#tab-3">
                                     <h6 class="mt-n1 mb-0">Part Time</h6>
                                 </a>
                             </li>
                             @foreach($parttime as $value)
                             <div class="tab-content">
                                 <div id="tab-1" class="tab-pane fade show p-0 active">
                                     <div class="job-item p-4 mb-4">
                                         <div class="row g-4">
                                             <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                                 <img class="flex-shrink-0 img-fluid border rounded" src="img/com-logo-1.jpg" alt="" style="width: 80px; height: 80px;">
                                                 <div class="text-start ps-4">

                                                     <li><a data-toggle="tab" href="#np{{ $value->job_type_id }}">{{ $value->job_title }}</a></li>

                                                 </div>
                                             </div>
                                             <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                                 <div class="d-flex mb-3">
                                                     <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
                                                     <a class="btn btn-primary" href="">Apply Now</a>
                                                 </div>
                                                 <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: 01 Jan, 2045</small>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 @endforeach
                             </div>
                         </div>
                     </div>
                 </div>
                 <a class="btn btn-primary py-3 px-5" href="">Browse More Jobs</a>
         </div>
     </div>

     <!-- Jobs End -->


     @endsection