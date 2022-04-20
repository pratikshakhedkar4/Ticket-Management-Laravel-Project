@extends("layouts.app")

@section("content")
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Assigned Ticket</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Assigned Ticket</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    <div class="card-body">
                        <table id="ticket" class="table table-bordered table-table-hover w-100 table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>User</th>
                                    <th>Mobile</th>
                                    <th>Assets</th>
                                    <th>Priority</th>
                                    <th>Serial Number</th>
                                    <th>Model Number</th>
                                    <th>Assign Agent</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                    
                                <tr>
                                    <td>{{$ticket->id}}</td>
                                    <td>{{$ticket->user->email}}</td>
                                    <td>{{$ticket->mobile}}</td>
                                    <td>{{$ticket->assets}}</td>
                                    <td>{{$ticket->priority}}</td>
                                    <td>{{$ticket->serial_number}}</td>
                                    <td>{{$ticket->model_number}}</td>
                                    <td>{{$ticket->agent->email}}</td>
                                    <td>
                                        <form action="{{url('agent/assign/'.$ticket->id)}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="radio" name="status" value="Pending" {{$ticket->status=="Pending"?'checked':''}}> Pending<br>
                                            <input type="radio" name="status" value="Approved" {{$ticket->status=="Approved"?'checked':''}}> Approved<br>
                                            <input type="radio" name="status" value="Ready to Dispatch" {{$ticket->status=="Ready to Dispatch"?'checked':''}}> Ready to Dispatch<br>
                                            <input type="radio" name="status" value="Dispatched" {{$ticket->status=="Dispatched"?'checked':''}}> Dispatched<br>
                                            <input type="radio" name="status" value="Closed" {{$ticket->status=="Closed"?'checked':''}}> Closed<br>
                                            <input type="submit" value="update" class="btn btn-outline-success">
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
@section("script")

<script>
    $(document).ready(function() {
        $("#ticket").DataTable({
            "responsive": true,
        });
    });
</script>
@endsection