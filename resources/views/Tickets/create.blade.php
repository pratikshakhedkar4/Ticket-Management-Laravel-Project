@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ticket</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/tickets') }}">Ticket</a></li>
                        <li class="breadcrumb-item active">Add Ticket</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Ticket</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ url('/tickets') }}">
                            @csrf
                            <div class="card-body row">
                                <div class="form-group col-md-6">
                                    <label for="users">User</label><span class="text-danger">*</span>
                                    <select name="users" class="form-control" id="users">
                                        <option value="" selected disabled>-- Select user --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{old('users')==$user->id?'selected':''}}>{{ $user->email }}</option>
                                        @endforeach

                                    </select>
                                    @error('users')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="mobile">Mobile</label><span class="text-danger">*</span>
                                    <input type="text" class="form-control" name="mobile" id="mobile"
                                        placeholder="Enter mobile number" autofocus value="{{ old('mobile') }}" readonly>
                                    @error('mobile')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="assets">Assets</label><span class="text-danger">*</span>
                                    <input type="text" class="form-control " name="assets" id="assets"
                                        placeholder="Enter assets " autofocus value="{{ old('assets') }}">
                                    @error('assets')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Priority</label><span class="text-danger">*</span>
                                    <select name="priority" class="form-control ">
                                        <option value="" selected disabled>-- Select priority --</option>

                                        <option value="low" {{old('priority')=='low'?'selected':''}}>low</option>
                                        <option value="medium" {{old('priority')=='medium'?'selected':''}}>Medium</option>
                                        <option value="high" {{old('priority')=='high'?'selected':''}}>High</option>
                                        <option value="emergency" {{old('priority')=='emergency'?'selected':''}}>Emergency</option>

                                    </select>
                                    @error('priority')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="serial_number">Serial Number</label><span class="text-danger">*</span>
                                    <input type="text" class="form-control" name="serial_number" id="sno"
                                        placeholder="Enter serial no" value="{{ old('serial_number') }}">
                                    @error('serial_number')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="model_number">Model Number</label><span class="text-danger">*</span>
                                    <input type="text" class="form-control" name="model_number" id="model"
                                        placeholder="Enter model no" value="{{ old('model_number') }}">
                                        @error('model_number')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Assign Agent</label><span class="text-danger">*</span>
                                    <select name="agent" class="form-control ">
                                        <option value="" selected disabled>-- Select Agent --</option>
                                        @foreach ($agents as $agent)
                                            <option value="{{ $agent->id }}" {{old('agent')==$agent->id?'selected':''}}>{{ $agent->email }}</option>
                                        @endforeach
                                    </select>
                                    @error('agent')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
    <!-- /.content-wrapper -->
@endsection
@section('script')
    <script>
        $(document).ready(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $(document).on("change", "#users", function() {
                        var userId = $(this).val();
                        if (userId) {
                            $.ajax({
                                type: "post",
                                url: "{{url('ticket/fetchMobile')}}",
                                data: {
                                    user_Id: userId
                                },
                                success: function(data) {
                                    $("#mobile").val(data.mobile);
                                
                                }
                            })
                        }
                    });
                })
    </script>
@endsection
