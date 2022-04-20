@extends("layouts.app")

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Report</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <div class="card card-outline card-primary">
                        <div class="card-body">
                            <form method="post" action="{{ url('/generateReport') }}">
                                @csrf
                                <div class="form-group col-6">
                                    <label>Start date</label><span class="text-danger">*</span>
                                    <input id="StartDate" name="StartDate" size="16" type="text"
                                        class="form-control" placeholder="Start Date" value="{{ old('StartDate') }}" />
                                    @error('StartDate')
                                    <strong><span class="text-danger">{{ $message }}</span><strong>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label class="control-label">End date</label><span class="text-danger">*</span>
                                    <input id="EndDate" name="EndDate" size="16" type="text"
                                        class="form-control" value="{{ old('EndDate') }}" placeholder="End Date"/>
                                    @error('EndDate')
                                    <strong><span class="text-danger">{{ $message }}</span><strong>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label>Priority</label><span class="text-danger">*</span>
                                    <select name="priority" class="form-control ">
                                        <option value="" selected disabled>-- Select priority --</option>

                                        <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>low</option>
                                        <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                                        <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                                        <option value="emergency" {{ old('priority') == 'emergency' ? 'selected' : '' }}>Emergency
                                        </option>

                                    </select>

                                    @error('priority')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label>Status</label><span class="text-danger">*</span>
                                    <select name="status" class="form-control">
                                        <option value="">---Select Status---</option>
                                        <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}> Pending
                                        </option>
                                        <option value="Approved" {{ old('status') == 'Approved' ? 'selected' : '' }}> Approved
                                        </option>
                                        <option value="Ready to Dispatch"
                                            {{ old('status') == 'Ready to Dispatch' ? 'selected' : '' }}> Ready to Dispatch
                                        </option>
                                        <option value="Dispatched" {{ old('status') == 'Dispatched' ? 'selected' : '' }}>
                                            Dispatched</option>
                                        <option value="Closed" {{ old('status') == 'Closed' ? 'selected' : '' }}> Closed</option>
                                    </select>
                                    @error('status')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <input type="submit" class="btn btn-success mt-3">
                            </form>
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
            $("#ticket").DataTable({
                responsive: true,
            });
            $("#StartDate").datepicker({
                numberOfMonths: 2,
                onSelect: function(selected) {
                    $("#EndDate").datepicker("option", "minDate", selected)
                }
            });
            $("#EndDate").datepicker({
                numberOfMonths: 2,
                onSelect: function(selected) {
                    $("#StartDate").datepicker("option", "maxDate", selected)
                }
            });

        });
    </script>
@endsection