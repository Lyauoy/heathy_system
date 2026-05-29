@extends('layouts.app')

@section('title', 'Edit Patient - SU30+')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Edit Patient</h4>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form action="{{ route('patients.update', $patient) }}" method="POST">
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Full Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name" value="{{ old('name', $patient->user->name) }}" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input class="form-control" type="email" name="email" value="{{ old('email', $patient->user->email) }}" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Age</label>
                            <input class="form-control" type="number" name="age" value="{{ old('age', $patient->age) }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Phone</label>
                            <input class="form-control" type="text" name="phone" value="{{ old('phone', $patient->phone) }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Blood Type</label>
                            <select class="form-control" name="blood_type">
                                <option value="">Select</option>
                                @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $bt)
                                    <option value="{{ $bt }}" {{ old('blood_type', $patient->blood_type) == $bt ? 'selected' : '' }}>{{ $bt }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Emergency Contact</label>
                            <input class="form-control" type="text" name="emergency_contact" value="{{ old('emergency_contact', $patient->emergency_contact) }}">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" name="address" rows="2">{{ old('address', $patient->address) }}</textarea>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Medical History</label>
                            <textarea class="form-control" name="medical_history" rows="3">{{ old('medical_history', $patient->medical_history) }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="m-t-20 text-center">
                    <button type="submit" class="btn btn-primary submit-btn">Update Patient</button>
                    <a href="{{ route('patients.index') }}" class="btn btn-secondary submit-btn">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
