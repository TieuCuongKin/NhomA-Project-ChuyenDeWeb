@extends('admin.layout')
@section('admin-content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Product Add</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
            <li class="breadcrumb-item active">Product Add</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
    <form action="{{ url('/product') }}" method="post" enctype="multipart/form-data">
      @csrf
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
                <label>Manufactures</label>
                <select name="manu_id" class="form-control custom-select" required>
                  <option selected disabled>Select one manufactures</option>
                  @foreach ($allmanus as $value) {
                  <option value="{{ $value->manu_id }}">
                    {{ $value->manu_name }}
                  </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="product_name" class="form-control" pattern="^[a-zA-Z0-9]*$" required>
              </div>
              <div class="form-group">
                <label>Price</label>
                <input type="number" name="price" class="form-control" min="0" required>
              </div>
              <div class="form-group">
                <label>Image</label>
                <input type="file" name="image" class="form-control" style="padding-bottom: 35px;" required>
              </div>
              <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="4" required></textarea>
              </div>
              <div class="form-group">
                <label>Quantity</label>
                <input type="number" name="quantity" class="form-control" min="0" required>
              </div>
              <div class="form-group">
                <label>Feature</label>
                <input type="number" name="feature" class="form-control" min="0" max="1" required>
              </div>
              <div class="form-group">
                <label>Sale</label>
                <input type="number" name="sale" class="form-control" min="0" required>
              </div>
              <div class="form-group">
                <label>Star</label>
                <input type="number" name="star" class="form-control" min="0" max="5" required>
              </div>
              <div class="form-group">
                <label>Created at</label>
                <input type="date" name="created_at" class="form-control" required>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="row" style="padding: 6px;">
        <div class="col-12">
          <a href="{{ url('/product') }}" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Create new Porject" class="btn btn-success float-right" name="submit">
        </div>
      </div>
    </form>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection