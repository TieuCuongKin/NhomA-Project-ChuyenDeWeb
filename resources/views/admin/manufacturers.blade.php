@extends('admin.layout')
@section('admin-content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Manufactures</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
            <li class="breadcrumb-item active">Manufactures</li>
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
        <form action="{{ url('/manufacturer/create') }}" method="get">
          <h3 class="card-title">Manufactures <button class="btn btn-info btn-sm">
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
              <th style="width: 25%" class="text-center">
                Manu id
              </th>
              <th style="width: 25%" class="text-center">
                Manu name
              </th>
              <th style="width: 50%" class="text-center">
                Action
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach($allmanus as $value)
            <tr>
              <td class="project-state">
                {{ $value->manu_id }}
              </td>
              <td class="project-state">
                {{ $value->manu_name }}
              </td>
              <td class="project-actions text-center">
                <form action="{{ url('/manufacturer/'.$value->manu_id.'/edit') }}" method="get" style="padding-bottom: 20px;">
                  <button class="btn btn-info btn-sm">
                    <i class="fas fa-pencil-alt">
                    </i>
                    Edit
                  </button>
                </form>
                <?php
                $temp = 0;
                foreach ($allproducts as $prod) {
                  if ($prod['manu_id'] == $value['manu_id']) {
                    $temp++;
                  }
                }
                if ($temp != 0) { ?>
                  <a class="btn btn-danger btn-sm" onclick="alert('Sản phầm còn tồn tại! Không thể xóa!')">
                    <i class="fas fa-trash">
                    </i>
                    Delete
                  </a>
                <?php } else { ?>
                  <form action="{{ url('/manufacturer/'.$value->manu_id) }}" method="post">
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