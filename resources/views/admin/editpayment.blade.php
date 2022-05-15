@extends('admin.layout')
@section('admin-content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Payment Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">Payment Edit</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="{{ url('/payment/'.$payment->payment_id) }}" method="post" enctype="multipart/form-data">
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
                                <label>Payment id</label>
                                <input readonly="false" name="payment_id" value="{{ $payment->payment_id }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>User name</label>
                                <select class="form-control custom-select" name="user_id" value="1" required>
                                    <option selected value="{{ $payment->user_id }}">{{ $allusers[$payment->user_id - 1]->name }}</option>
                                    @foreach ($allusers as $value) {
                                    <option value="{{ $value->id }}">
                                        {{ $value->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Discount</label>
                                <input type="number" name="discount" class="form-control" min="0" value="{{ $payment->discount }}" required>
                            </div>
                            <div class="form-group">
                                <label>Created at</label>
                                <input type="date" name="created_at" class="form-control" value="{{ date('Y-m-d',strtotime($payment->created_at)) }}" required>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{ url('/payment') }}" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Save Changes" class="btn btn-success float-right" name="submit">
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection