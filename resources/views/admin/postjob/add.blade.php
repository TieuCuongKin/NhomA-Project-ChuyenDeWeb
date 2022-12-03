@extends('layout.admin')
@section('content')
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Post A New Job On Website</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Post Job</a></li>
                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                </div>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <form id="form-edit" method="POST" role="form" action="{{ route('admin.jobseeker.add') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="exampleInputTitle" name="title">
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Company</label>
                                    <select name="company" id="company" class="form-control" required="required">
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="job_location_id">Location</label>
                                    <select name="job_location_id" id="job_location_id" class="form-control" required="required">
                                        @foreach($locations as $location)
                                            <option value="{{ $location->id }}">{{ $location->location_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-2">
                                    <label for="exampleInputSalaryMin" class="form-label">Salary Min</label>
                                    <input type="number" class="form-control" id="exampleInputSalaryMin" name="salary_min">
                                </div>
                                <div class="col-2">
                                    <label for="exampleInputSalaryMax" class="form-label">Salary Max</label>
                                    <input type="number" class="form-control" id="exampleInputSalaryMax" name="salary_max">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="mb-3">
                                <label for="exampleDescription" class="form-label">Job Description</label>
                                <textarea id="summernote" name="job_description"></textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleExpiry" class="form-label">Job Expired</label>
                            <input type="date" class="form-control" id="exampleExpiry" name="job_expiry">
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="status" id="status-edit" class="form-control" required="required">
                                    <option value="1">Active</option>
                                    <option value="2">Deactivate</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </main>
        </div>
    </div>
@endsection