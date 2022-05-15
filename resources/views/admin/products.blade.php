@extends('admin.layout')
@section('admin-content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Products</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
            <li class="breadcrumb-item active">Products</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <form action="{{ url('/product/create') }}" method="get">
          <h3 class="card-title">Products <button class="btn btn-info btn-sm">
              <i class="fas fa-pencil-alt">
              </i>
              Add
            </button>
          </h3>
        </form>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body p-0">
        <table class="table table-striped projects">
          <thead>
            <tr>
              <th class="text-center">
                Product id
              </th>
              <th class="text-center">
                Manu name
              </th>
              <th style="width: 15%" class="text-center">
                Product name
              </th>
              <th class="text-center">
                Price
              </th class="text-center">
              <th>
                Image
              </th>
              <th style="width: 100%" class="text-center">
                Description
              </th>
              <th class="text-center">
                Quantity
              </th>
              <th class="text-center">
                Feature
              </th>
              <th class="text-center">
                Sale
              </th>
              <th class="text-center">
                Star
              </th>
              <th class="text-center">
                Created at
              </th>
              <th class="text-center">
                Action
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach($allproducts as $value)
            <tr>
              <td class="project-state">
                {{ $value->product_id }}
              </td>
              <td class="project-state">
                {{ $allmanus[$value->manu_id - 1]->manu_name }}
              </td>
              <td class="project-state">
                {{ $value->product_name }}
              </td>
              <td class="project_progress">
                {{ number_format($value->price) }}
              </td>
              <td class="project-state">
                <img src="{{ asset('img/'.$value->image) }}" alt="" style="width: 50px;">
              </td>
              <td class="project-state">
                {{ $value->description }}
              </td>
              <td class="project-state">
                {{ $value->quantity }}
              </td>
              <td class="project-state">
                {{ $value->feature }}
              </td>
              <td class="project-state">
                {{ $value->sale }}
              </td>
              <td class="project-state">
                {{ $value->star }}
              </td>
              <td class="project-state">
                {{ date('d/m/Y', strtotime($value->created_at)) }}
              </td>
              <td class="project-actions text-right">
                <form action="{{ url('/product/'.$value->product_id.'/edit') }}" method="get" style="padding-bottom: 20px;">
                  <button class="btn btn-info btn-sm">
                    <i class="fas fa-pencil-alt">
                    </i>
                    Edit
                  </button>
                </form>
                <?php
                $temp = 0;
                foreach ($alldetails as $detail) {
                  if ($detail['product_id'] == $value['product_id']) {
                    $temp++;
                  }
                }
                foreach ($allothers as $other) {
                  if ($other['product_id'] == $value['product_id']) {
                    $temp++;
                  }
                }
                if ($temp != 0) { ?>
                  <a class="btn btn-danger btn-sm" onclick="alert('Sản phầm còn tồn tại trong chi tiết hoặc khác! Không thể xóa!')">
                    <i class="fas fa-trash">
                    </i>
                    Delete
                  </a>
                <?php } else { ?>
                  <form action="{{ url('/product/'.$value->product_id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">
                      <i class="fas fa-trash">
                      </i>
                      Delete
                    </button>
                  </form>
                <?php } ?>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection