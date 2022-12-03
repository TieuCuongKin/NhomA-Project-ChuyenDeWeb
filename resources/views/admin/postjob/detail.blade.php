@extends('layout.admin')
@section('content')
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Company Detail</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Company</a></li>
                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                </div>
                <!-- Job Detail Start -->
                <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="container">
                        <div class="row gy-5 gx-4">
                            <div class="col-lg-8">
                                <div class="d-flex align-items-center mb-5">
                                    <img class="flex-shrink-0 img-fluid border rounded" src="{{ $job['images'] }}" alt="" style="width: 80px; height: 80px;">
                                    <div class="text-start ps-4">
                                        <h3 class="mb-3">{{ $job['job_title'] }}</h3>
                                        <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $job['job_location'] }}</span>
                                        <span class="text-truncate me-3"><i class="far fa-building text-primary me-2"></i>{{ $job['company_name'] }}</span>
                                        <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>${{$job['job_salary_min']}} - ${{$job['job_salary_max']}}</span>
                                    </div>
                                </div>

                                <div class="mb-5">
                                    <h4 class="mb-3">Job description</h4>
                                    <?php echo $job['job_description'] ?>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="bg-light rounded mb-4 wow slideInUp" data-wow-delay="0.1s">
                                    <h4 class="mb-4">Job Summery</h4>
                                    <p><i class="fa fa-angle-right text-primary me-2"></i>Salary: ${{$job['job_salary_min']}} - ${{$job['job_salary_max']}}</p>
                                    <p><i class="fa fa-angle-right text-primary me-2"></i>Location: {{ $job['job_location'] }}</p>
                                    <p class="m-0"><i class="fa fa-angle-right text-primary me-2"></i>Date Line: {{ $job['job_expired_at'] }}</p>
                                </div>
                                <div class="bg-light rounded wow slideInUp" data-wow-delay="0.1s">
                                    <h4 class="mb-4">Company Detail</h4>
                                    <?php echo $job['company_description']?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Job Detail End -->
@endsection