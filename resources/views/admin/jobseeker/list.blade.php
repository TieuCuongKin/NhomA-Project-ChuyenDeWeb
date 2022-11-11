@extends('layout.admin')
@section('content')
    <!-- Navbar-->
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Tables</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tables</li>
                    </ol>
                </div>
                <div class="container-fluid px-4">
                    <table class="table">
                        <thead>
                        ...
                        </thead>
                        <tbody>
                        <tr class="table-active">
                            ...
                        </tr>
                        <tr>
                            ...
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td colspan="2" class="table-active">Larry the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </main>
        </div>
    </div>
@endsection