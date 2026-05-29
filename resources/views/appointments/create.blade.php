@extends('layouts.app')

@section('title', 'Add Appointment - SU30+')

@section('content')
<div class="content">
    <div class="row"><div class="col-sm-12"><h4 class="page-title">Add Appointment</h4></div></div>

    @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form action="{{ route('appointments.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Patient <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="patient_id" required>
                                <option value="">Select Patient</option>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>{{ $patient->user->name ?? 'N/A' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
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
                            <label>Department <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="department_id" required>
                                <option value="">Select Department</option>
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Appointment Date <span class="text-danger">*</span></label>
                            <input class="form-control datetimepicker" type="text" name="appointment_date" value="{{ old('appointment_date') }}" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Reason for Visit</label>
                            <input class="form-control" type="text" name="reason_for_visit" value="{{ old('reason_for_visit') }}">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Notes</label>
                            <textarea class="form-control" name="notes" rows="3">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="m-t-20 text-center">
                    <button type="submit" class="btn btn-primary submit-btn">Create Appointment</button>
                    <a href="{{ route('appointments.index') }}" class="btn btn-secondary submit-btn">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
