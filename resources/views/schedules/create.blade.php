@extends('layouts.app')

@section('title', 'Add Schedule - SU30+')

@section('content')
<div class="content">
    <div class="row"><div class="col-sm-12"><h4 class="page-title">Add Schedule</h4></div></div>

    @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form action="{{ route('schedules.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Doctor <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="doctor_id" required>
                                <option value="">Select Doctor</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>Dr. {{ $doctor->user->name ?? 'N/A' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Day <span class="text-danger">*</span></label>
                            <select class="form-control" name="day" required>
                                <option value="">Select Day</option>
                                @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
                                    <option value="{{ $day }}" {{ old('day') == $day ? 'selected' : '' }}>{{ $day }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Start Time <span class="text-danger">*</span></label>
                            <input class="form-control" type="time" name="start_time" value="{{ old('start_time') }}" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>End Time <span class="text-danger">*</span></label>
                            <input class="form-control" type="time" name="end_time" value="{{ old('end_time') }}" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="m-t-20 text-center">
                    <button type="submit" class="btn btn-primary submit-btn">Create Schedule</button>
                    <a href="{{ route('schedules.index') }}" class="btn btn-secondary submit-btn">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
