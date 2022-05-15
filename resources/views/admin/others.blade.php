@extends('admin.layout')
@section('admin-content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Others</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
            <li class="breadcrumb-item active">Others</li>
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
        <form action="{{ url('/other/create') }}" method="get">
          <h3 class="card-title">Others <button class="btn btn-info btn-sm">
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
              <th style="width: 15%" class="text-center">
                Other id
              </th>
              <th style="width: 15%" class="text-center">
                Product name
              </th>
              <th style="width: 15%" class="text-center">
                User name
              </th>
              <th style="width: 15%" class="text-center">
                Like
              </th>
              <th style="width: 20%" class="text-center">
                Submit
              </th>
              <th style="width: 15%" class="text-center">
                Star
              </th>
              <th style="width: 20%" class="text-center">
                Action
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach($allothers as $value)
            <tr>
              <td class="project-state">
                {{ $value->other_id }}
              </td>
              <td class="project-state">
                {{ $allproducts[$value->product_id - 1]->product_name }}
              </td>
              <td class="project-state">
                <?php if ($value->user_id == "0") {
                  echo 'guest';
                }
                else {
                  echo $allusers[$value->user_id - 1]->name;
                }
                ?>
              </td>
              <td class="project-state">
                {{ $value->like }}
              </td>
              <td class="project-state">
                {{ $value->submit }}
              </td>
              <td class="project-state">
                {{ $value->star }}
              </td>
              <td class="project-actions text-center">
                <form action="{{ url('/other/'.$value->other_id.'/edit') }}" method="get" style="padding-bottom: 20px;">
                  <button class="btn btn-info btn-sm">
                    <i class="fas fa-pencil-alt">
                    </i>
                    Edit
                  </button>
                </form>
                <form action="{{ url('/other/'.$value->other_id) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm">
                    <i class="fas fa-trash">
                    </i>
                    Delete
                  </button>
                </form>
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