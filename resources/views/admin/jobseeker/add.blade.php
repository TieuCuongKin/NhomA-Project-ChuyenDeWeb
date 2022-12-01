@extends('layout.admin')
@section('content')
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Add JobSeeker</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">JobSeeker</a></li>
                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                </div>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <form id="form-edit" method="POST" role="form" action="{{ route('admin.jobseeker.add') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                   aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFullName" class="form-label">Full name</label>
                            <input type="text" class="form-control" id="exampleInputFullName" name="fullname">
                        </div>
                        <div class="form-group">
                            <label for="">Gender</label>
                            <select name="gender" id="gender-edit" class="form-control" required="required">
                                <option value="0">Male</option>
                                <option value="1">Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="examplePhone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="exampleInputPhone" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="exampleAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="exampleInputAddress" name="address">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </main>
        </div>
    </div>
@endsection