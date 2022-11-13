@extends('layout.admin')
@section('content')
    <!-- Navbar-->
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">List JobSeeker</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">JobSeeker</a></li>
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
                                        <th width="20%">Name</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($jobseekers as $jobseeker)
                                        <tr>
                                            <td>{{ $jobseeker['id'] }}</td>
                                            <td>{{ $jobseeker['full_name'] }}</td>
                                            @if( $jobseeker['gender'] == 0)
                                                <td>Male</td>
                                            @else
                                                <td>Female</td>
                                            @endif
                                            <td>{{ $jobseeker['phone'] }}</td>
                                            <td>{{ $jobseeker['email'] }}</td>
                                            @if( $jobseeker['status'] == 1)
                                                <td><span class="badge rounded-pill bg-success">Active</span></td>
                                            @else
                                                <td><span class="badge rounded-pill bg-danger">Deactivate</span></td>
                                            @endif
                                            <td class="text-center">
                                                <button data-url="{{ route('admin.jobseeker.edit',$jobseeker['id']) }}"
                                                        data-target="#edit" data-toggle="modal"
                                                        class="btn-info btn-edit" type="button">
                                                    <i class="fa-solid fa-pencil"></i></button>
                                                <button data-url="{{ route('admin.jobseeker.show',$jobseeker['id']) }}"
                                                        data-target="#show" data-toggle="modal"
                                                        type="button" class="btn-success">
                                                    <i class="fa-solid fa-eye"></i></button>
                                                <button data-url="{{ route('admin.jobseeker.delete',$jobseeker['id']) }}"
                                                        data-target="#delete" data-toggle="modal"
                                                        class="btn-danger btn-delete" type="button">
                                                    <i class="fa-solid fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                        {{ $jobseekers->links('pagination::bootstrap-4') }}
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    @include('admin.jobseeker.edit')
                    @include('admin.jobseeker.detail')

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
                                            toastr.success('Delete student success!')
                                            window.location.reload();
                                        },
                                        error: function (jqXHR, textStatus, errorThrown) {

                                        }
                                    })
                                }
                            })
                            $('.btn-edit').click(function (e) {
                                var url = $(this).attr('data-url');
                                $('#modal-edit').modal('show');
                                e.preventDefault();
                                $.ajax({
                                    //phương thức get
                                    type: 'get',
                                    url: url,
                                    success: function (response) {
                                        //đưa dữ liệu controller gửi về điền vào input trong form edit.
                                        $('#email-edit').val(response.data.email);
                                        $('#fullname-edit').val(response.data.full_name);
                                        $('#gender-edit').val(response.data.gender);
                                        $('#phone-edit').val(response.data.phone);
                                        //thêm data-url chứa route sửa todo đã được chỉ định vào form sửa.
                                        $('#form-edit').attr('data-url', '{{ asset('/admin/user/edit') }}/'+ response.data.id);
                                    },
                                    error: function (error) {

                                    }
                                })
                            })
                            $('#form-edit').submit(function (e) {
                                e.preventDefault();
                                var url = $(this).attr('data-url');
                                $.ajax({
                                    type: 'put',
                                    url: url,
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    data: {
                                        email: $('#email-edit').val(),
                                        fullname: $('#fullname-edit').val(),
                                        gender: $('#gender-edit').val(),
                                        phone: $('#phone-edit').val(),
                                    },
                                    success: function (response) {
                                        window.location.reload();
                                    },
                                    error: function (jqXHR, textStatus, errorThrown) {

                                    }
                                })
                            })
                            $('.btn-show').click(function(){
                                var url = $(this).attr('data-url');
                                $.ajax({
                                    type: 'get',
                                    url: url,
                                    success: function(response) {
                                        console.log(response)
                                        $('p#id').text(response.data.id)
                                        $('p#fullname').text(response.data.fullname)
                                        $('p#gender').text(response.data.gender)
                                        $('p#phone').text(response.data.phone)
                                        $('p#address').text(response.data.address)
                                        $('p#status').text(response.data.status)
                                        $('p#created_at').text(response.data.created_at)
                                        $('p#update_at').text(response.data.update_at)
                                    },
                                    error: function (jqXHR, textStatus, errorThrown) {

                                    }
                                })
                            })
                        })
                    </script>
                    <!-- /.container-fluid -->
                </div>
            </main>
        </div>
    </div>
@endsection