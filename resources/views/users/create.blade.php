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
                <h1>User Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/users') }}">User Management</a></li>
                    <li class="breadcrumb-item active">Add User</li>
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
                        <h3 class="card-title">Add User</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ url('/users') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body row">
                        <div class="form-group col-md-6">
                                <label for="fname">User name</label><span class="text-danger">*</span>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" autofocus value="{{ old('username') }}">
                                @error('username')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="mobile">Mobile</label><span class="text-danger">*</span>
                                <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile" autofocus value="{{ old('mobile') }}">
                                @error('mobile')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="first_name">First Name</label><span class="text-danger">*</span>
                                <input type="text" class="form-control" name="first_name" id="fname" placeholder="Enter First Name" autofocus value="{{ old('first_name') }}">
                                @error('first_name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="lname" placeholder="Enter last name" value="{{ old('last_name') }}">
                                @error('last_name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label>Select Role</label><span class="text-danger">*</span>
                                <select name="role" class="form-control ">
                                    @if(Auth::user()->isAdmin())
                                    <option value="">Choose role...</option>
                                    <option value="subadmin" {{old('role')=="subadmin"?"selected":''}}>Sub Admin</option>
                                    <option value="agent" {{old('role')=="agent"?"selected":''}}>Agent</option>
                                    @endif
                                    @if(Auth::user()->isSubAdmin())
                                    <option value="">Choose role...</option>
                                    <option value="user" {{old('role')=="user"?"selected":''}}>User</option>
                                    @endif
                                </select>
                                @error('role')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="profile_picture">Profile</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input " id="profile_picture" name="profile_picture" multiple>
                                        <label class="custom-file-label" for="profile_picture">Choose file</label>
                                    </div>
                                </div>
                                @error('profile_picture')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 my-3">
                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input type="radio" class="custom-control-input" id="customSwitch3" value="active" name="status" checked>
                                    <label class="custom-control-label" for="customSwitch3">Active</label>
                                </div>
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

<!-- toastr Js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@if (session('status') === "success")

<!-- toastr success -->
<script>
    toastr.success("User Added Successfully");
</script>

@elseif (session('status') === "failed")

<!-- toastr danger  -->
<script>
    toastr.error("Failed to add user.");
</script>

@endif
@endsection