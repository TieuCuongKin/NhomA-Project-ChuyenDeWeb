@extends('layout.admin')
@section('content')
    <!-- Navbar-->
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="row">
                        <div class="col-4"><h1>List Companies</h1></div>
                        <div class="col-5">
                            <!-- Topbar Search -->
                            <form method="POST" action="{{ route('admin.company.list') }}" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                                @csrf
                                <div class="input-group">
                                    <input name="search" type="text" class="form-control bg-white border-0 small" placeholder="Search for..."
                                           aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col">
                            <form action="{{route('admin.company.add')}}">
                                <button class="btn btn-primary" type="submit">Add Company +</button>
                            </form>
                        </div>
                    </div>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Company</a></li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th width="20%">Image</th>
                                        <th width="20%">Company Name</th>
                                        <th>Company Contact</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($companies as $company)
                                        <tr>
                                            <td>{{ $company->id }}</td>
                                            <td><img src="{{ asset($company->image) }}" width="100px"></td>
                                            <td>{{ $company->company_name }}</td>
                                            <td>{{ $company->company_contact }}</td>
                                            @if( $company->user->status )
                                                <td><span class="badge rounded-pill bg-success">Active</span></td>
                                            @else
                                                <td><span class="badge rounded-pill bg-danger">Deactivate</span></td>
                                            @endif
                                            <td class="text-center">
                                                <a href="{{ route('admin.company.edit',$company['id']) }}"
                                                   class="btn btn-info btn-edit"><i class="fa-solid fa-edit"></i></a>

                                                <a href="{{ route('admin.company.show',$company['id']) }}"
                                                   class="btn btn-success btn-show"><i class="fa-solid fa-eye"></i></a>

                                                <button data-url="{{ route('admin.company.delete',$company['id']) }}"
                                                        data-target="#delete" data-toggle="modal"
                                                        class="btn btn-danger btn-delete" type="button">
                                                    <i class="fa-solid fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{ $companies->links() }}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"
                            type="text/javascript" charset="utf-8" async defer></script>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('.btn-delete').click(function(){
                                var url = $(this).attr('data-url');
                                var _this = $(this);
                                if (confirm('Are you sure to delete?')) {
                                    $.ajax({
                                        type: 'delete',
                                        url: url,
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        success: function(response) {
                                            toastr.success('Delete company success!')
                                            window.location.reload();
                                        },
                                        error: function (jqXHR, textStatus, errorThrown) {

                                        }
                                    })
                                }
                            })
                        })
                    </script>
                    <!-- /.container-fluid -->
                </div>
            </main>
        </div>
    </div>
@endsection