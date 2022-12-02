@extends('layout.admin')
@section('content')
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Add Company</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Company</a></li>
                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                </div>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <form id="form-edit" method="POST" role="form" action="{{ route('admin.company.add') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                       aria-describedby="emailHelp">
                            </div>
                            <div class="col-6">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleCompanyName" class="form-label">Company Name</label>
                            <input type="text" class="form-control" id="exampleInputCompanyName" name="companyName">
                        </div>
                        <div class="mb-3">
                            <label for="exampleAddress" class="form-label">Company Address</label>
                            <input type="text" class="form-control" id="exampleInputAddress" name="companyAddress">
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="examplePhone" class="form-label">Company Contact</label>
                                <input type="text" class="form-control" id="exampleInputPhone" name="companyPhone">
                            </div>
                            <div class="col-6">
                                <label for="exampleWebsite" class="form-label">Company Website</label>
                                <input type="text" class="form-control" id="exampleInputWebsite" name="companyWebsite">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleDescription" class="form-label">Description</label>
                            <textarea id="summernote" name="editordata"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFile" class="form-label">Company Logo</label>
                            <input type="file" name="file" class="form-control" id="images"/>
                            <div id="image_show">

                            </div>
                        </div>
                        <div class="row justify-content-center" id="showImage"></div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"
            type="text/javascript" charset="utf-8" async defer></script>
    <script src="{{ url('admin/js/main.js') }}"></script>

@endsection