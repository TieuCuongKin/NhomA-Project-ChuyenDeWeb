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
                <div class="container-xxl py-5 wow fadeInUp">
                    <div class="container">
                        <div class="row gy-5 gx-4">
                                <div class="d-flex align-items-center mb-5">
                                    <img class="flex-shrink-0 img-fluid border rounded"
                                         src="{{ asset($company['image']) }}" alt=""
                                         style="width: 80px; height: 80px;">
                                    <div class="text-start ps-4">
                                        <h3 class="mb-3">{{ $company['company_name'] }}</h3>
                                        <span class="text-truncate me-3"><i
                                                    class="fa fa-map-marker-alt text-primary me-2"></i>{{ $company['company_address'] }}</span>
                                        <span class="text-truncate me-3"><i
                                                    class="fa-solid fa-phone text-primary me-2"></i>{{ $company['company_contact'] }}</span>
                                        <span class="text-truncate me-3"><i class="fa-solid fa-globe text-primary me-2"></i><a
                                                    href="{{ $company['company_website'] }}">{{ $company['company_website'] }}</a></span>
                                    </div>
                                </div>

                                <div class="mb-5">
                                    <h4 class="mb-3">Company description</h4>
                                    <p><?php echo $company['description']  ?></p>

                                </div>
                            </div>
                        </div>
                    </div>
                <!-- Job Detail End -->
@endsection