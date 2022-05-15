@extends('admin.layout')
@section('admin-content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Other Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">Other Edit</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="{{ url('/other/'.$other->other_id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Other id</label>
                                <input readonly="false" name="other_id" value="{{ $other->other_id }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Product name</label>
                                <select class="form-control custom-select" name="product_id" value="1" required>
                                    <option selected value="{{ $other->product_id }}">{{ $allproducts[$other->product_id - 1]->product_name }}</option>
                                    @foreach ($allproducts as $value) {
                                    <option value="{{ $value->product_id }}">
                                        {{ $value->product_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>User name</label>
                                <select class="form-control custom-select" name="user_id" value="1" required>
                                    <option selected value="{{ $other->user_id }}">
                                        <?php if ($other->user_id == "0") {
                                            echo 'guest';
                                        } else {
                                            echo $allusers[$other->user_id - 1]->name;
                                        } ?>
                                    </option>
                                    @foreach ($allusers as $value) {
                                    <option value="{{ $value->id }}">
                                        {{ $value->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Like</label>
                                <input type="number" name="like" class="form-control" value="{{ $other->like }}" min="0" max="1" required>
                            </div>
                            <div class="form-group">
                                <label>Submit</label>
                                <input type="text" name="submit" class="form-control" value="{{ $other->submit }}" required>
                            </div>
                            <div class="form-group">
                                <label>Like</label>
                                <input type="number" name="star" class="form-control" value="{{ $other->star }}" min="0" max="5" required>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{ url('/other') }}" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Save Changes" class="btn btn-success float-right" name="btnsubmit">
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection