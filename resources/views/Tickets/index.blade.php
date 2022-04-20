@extends("layouts.app")

@section("content")
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Ticket</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Ticket</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title float-right"><a href="{{url('tickets/create')}}" class="btn btn-success"><i class="fas fa-plus"></i></a></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="ticket" class="table table-striped table-bordered table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Assets</th>
                                    <th>Priority</th>
                                    <th>Serial Number</th>
                                    <th>Model Number</th>
                                    <th>Assign Agent</th>
                                    <th>Status</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                    
                                <tr>
                                    <td>{{$ticket->id}}</td>
                                    <td>{{$ticket->user->email}}</td>
                                    <td>{{$ticket->user->first_name." ".$ticket->user->last_name}}</td>
                                    <td>{{$ticket->mobile}}</td>
                                    <td>{{$ticket->assets}}</td>
                                    <td>{{$ticket->priority}}</td>
                                    <td>{{$ticket->serial_number}}</td>
                                    <td>{{$ticket->model_number}}</td>
                                    <td>{{$ticket->agent->email}}</td>
                                    <td>{{$ticket->status}}</td>
                                    
                                    {{-- <td class="text-center">
                                        <button class="btn btn-warning edit my-1" ><i class="fas fa-pen"></i></button>
                                        <button class="btn btn-danger delete my-1" ><i class="fas fa-trash-alt"></i></button>
                                    </td> --}}
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
@section("script")

<script>
    $(document).ready(function() {
        $("#ticket").DataTable();
    });
</script>
@endsection