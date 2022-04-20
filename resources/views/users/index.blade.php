@extends("layouts.app")

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">User Management</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title float-right"><a href="{{ url('/users/create') }}" class="btn btn-success">
                                    <i class="fas fa-plus"></i></a></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="user" class="table table-bordered table-striped table-hover table-responsive"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Username</th>
                                        <th>Mobile</th>
                                        <th>Firstname</th>
                                        <th>lastname</th>
                                        <th>Role</th>
                                        <th>Profile</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->mobile }}</td>
                                            <td>{{ $user->first_name }}</td>
                                            <td>
                                                @if (!empty($user->last_name))
                                                    {{ $user->last_name }}
                                                @else
                                                    <span class="text-warning">Not Available</span>
                                                @endif
                                            </td>
                                            <td>{{ $user->role }}</td>
                                            <td>
                                                @if (!empty($user->profile_pic))
                                                    <img src="{{ asset('/profiles' . '/' . $user->profile_pic) }}"
                                                        style="width:50px;height:60px;">
                                                @else
                                                    <span class="text-warning">Not Available</span>
                                                @endif
                                            </td>
                                            <td>{{ $user->status }}</td>

                                            <td class="text-center">
                                                <form action="/users/{{ $user->id }}" method="post">
                                                    @csrf()
                                                    @method('delete')
                                                    <a href="/users/{{ $user->id }}/edit" class="btn btn-primary"><i
                                                            class="fas fa-pen"></i></a>
                                                    <button type="submit"
                                                        onclick="return confirm('Do you really want to delete this record!')"
                                                        class="btn btn-danger">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>

                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $("#user").DataTable();
        });
    </script>
@endsection
