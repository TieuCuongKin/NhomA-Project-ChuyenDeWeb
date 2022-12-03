@extends('layout.admin')
@section('content')
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Edit Company</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Company</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <form id="form-add" method="POST" role="form" action="{{ route('admin.company.edit', $company['id']) }}">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                      value="{{$company['email']}}" aria-describedby="emailHelp">
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" id="status-edit" class="form-control" required="required">
                                        <option value="1">Active</option>
                                        <option value="2">Deactivate</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleCompanyName" class="form-label">Company Name</label>
                            <input type="text" class="form-control" id="exampleInputCompanyName" name="companyName" value="{{ $company['company_name'] }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleAddress" class="form-label">Company Address</label>
                            <input type="text" class="form-control" id="exampleInputAddress" name="companyAddress" value="{{ $company['company_address'] }}">
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="examplePhone" class="form-label">Company Contact</label>
                                <input type="text" class="form-control" id="exampleInputPhone" name="companyContact" value="{{ $company['company_contact'] }}">
                            </div>
                            <div class="col-6">
                                <label for="exampleWebsite" class="form-label">Company Website</label>
                                <input type="text" class="form-control" id="exampleInputWebsite" name="companyWebsite" value="{{ $company['company_website'] }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleDescription" class="form-label">Description</label>
                            <textarea id="summernote" name="companyDescription"> <?php echo $company['description'] ?> </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFile" class="form-label">Company Logo</label>
                            <input type="file" class="form-control" id="images" name="file"/>
                            <div id="image_show">

                            </div>
                            <input type="hidden" name="thumb" id="thumb" value="{{ $company['image'] }}" class="form-control">
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