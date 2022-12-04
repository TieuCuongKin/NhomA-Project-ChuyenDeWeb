@extends('layout.admin')
@section('content')
    <!-- Navbar-->
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="row">
                        <div class="col-9"><h1>List Job</h1></div>
                        <div class="col-3">
                            <!-- Topbar Search -->
                            <form method="POST" action="{{ route('admin.postjob.index') }}" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
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
                    </div>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Company</a></li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @include('layout.alert')
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th width="20%">Job title</th>
                                        <th width="20%">Company Name</th>
                                        <th>Location</th>
                                        <th>Expired</th>
                                        <th>Status</th>
                                        <th width="20%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($jobs as $job)
                                        <tr>
                                            <td>{{ $job->id }}</td>
                                            <td>{{ $job->job_title }}</td>
                                            <td>{{ $job->company->company_name }}</td>
                                            <td>{{ $job->location->location_name }}</td>
                                            <td>{{ $job->job_expired_at }}</td>
                                            @if( $job->job_status )
                                                <td><span class="badge rounded-pill bg-success">Active</span></td>
                                            @else
                                                <td><span class="badge rounded-pill bg-danger">Deactivate</span></td>
                                            @endif
                                            <td class="text-center">
                                                <form action="{{ route('admin.postjob.delete', $job['id']) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('admin.postjob.edit', $job['id']) }}"
                                                       class="btn btn-info btn-edit"><i
                                                                class="fa-solid fa-edit"></i></a>

                                                    <a href="{{ route('admin.postjob.show',$job['id']) }}"
                                                       class="btn btn-success btn-show"><i class="fa-solid fa-eye"></i></a>

                                                    <button type="submit" class="btn btn-danger btn-delete"
                                                            onclick="return confirm('Are you sure to delete?')">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{ $jobs->links() }}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </div>
            </main>
        </div>
    </div>
@endsection