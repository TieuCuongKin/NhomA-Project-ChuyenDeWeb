@extends('admin.layout')
@section('admin-content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Product Edit</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
            <li class="breadcrumb-item active">Product Edit</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <form action="{{ url('/product/'.$product->product_id) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('patch')
      <div class="row">
        <div class="col-md-6">
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
                <label>Product id</label>
                <input readonly="false" name="product_id" value="{{ $product->product_id }}" class="form-control">
              </div>
              <div class="form-group">
                <label>Manu id</label>
                <select class="form-control custom-select" name="manu_id" value="1" required>
                  <option selected value="{{ $product->manu_id }}">{{ $allmanus[$product->manu_id - 1]->manu_name }}</option>
                  @foreach ($allmanus as $value) {
                  <option value="{{ $value->manu_id }}">
                    {{ $value->manu_name }}
                  </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Product name</label>
                <input type="text" name="product_name" class="form-control" value="{{ $product->product_name }}" pattern="^[a-zA-Z0-9]*$" required>
              </div>
              <div class="form-group">
                <label>Price</label>
                <input type="number" name="price" class="form-control" value="{{ $product->price }}" min="0" required>
              </div>
              <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="4" required>{{ $product->description }}</textarea>
              </div>
              <div class="form-group">
                <label>Quantity</label>
                <input type="number" name="quantity" class="form-control" value="{{ $product->quantity }}" min="0" required>
              </div>
              <div class="form-group">
                <label>Feature</label>
                <input type="number" name="feature" class="form-control" value="{{ $product->feature }}" min="0" max="1" required>
              </div>
              <div class="form-group">
                <label>Sale</label>
                <input type="number" name="sale" class="form-control" value="{{ $product->sale }}" min="0" required>
              </div>
              <div class="form-group">
                <label>Star</label>
                <input type="number" name="star" class="form-control" value="{{ $product->star }}" min="0" max="5" required>
              </div>
              <div class="form-group">
                <label>Created at</label>
                <input type="date" name="created_at" class="form-control" value="{{ date('Y-m-d',strtotime($product->created_at)) }}" required>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <!-- /.card -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Files image</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <table class="table">
                <thead>
                  <tr>
                    <th>Image name</th>
                    <th>Image</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{ $product->image }}</td>
                    <td><img src="{{ asset('img/'.$product->image) }}" alt="" style="width: 50px;"></td>
                    <td class="text-right py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label>Image</label>
                <input type="file" name="image" class="form-control" style="padding-bottom: 35px;">
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
      <div class="row" style="padding: 6px;">
          <div class="col-12">
            <a href="{{ url('/product') }}" class="btn btn-secondary">Cancel</a>&emsp;
            <input type="submit" value="Save Changes" class="btn btn-success float-right" name="submit">
          </div>
        </div>
    </form>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection