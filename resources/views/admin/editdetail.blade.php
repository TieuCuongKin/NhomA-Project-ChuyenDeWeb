@extends('admin.layout')
@section('admin-content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">Detail Edit</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="{{ url('/detail/'.$detail->detail_id) }}" method="post" enctype="multipart/form-data">
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
                                <label>Detail id</label>
                                <input readonly="false" name="detail_id" value="{{ $detail->detail_id }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Product name</label>
                                <select class="form-control custom-select" name="product_id" value="1" required>
                                    <option selected value="{{ $detail->product_id }}">{{ $allproducts[$detail->product_id - 1]->product_name }}</option>
                                    @foreach ($allproducts as $value) {
                                    <option value="{{ $value->product_id }}">
                                        {{ $value->product_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Payment id</label>
                                <select class="form-control custom-select" name="payment_id" value="1" required>
                                    <option selected value="{{ $detail->payment_id }}">{{ $detail->payment_id }}</option>
                                    @foreach ($allpayments as $value) {
                                    <option value="{{ $value->payment_id }}">
                                        {{ $value->payment_id }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number" name="quantity" class="form-control" value="{{ $detail->quantity }}" min="0" required>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{ url('/detail') }}" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Save Changes" class="btn btn-success float-right" name="submit">
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection