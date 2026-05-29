@extends('layouts.app')

@section('title', 'Add Patient - SU30+')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Add Patient</h4>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form action="{{ route('patients.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Full Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Username <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="username" value="{{ old('username') }}" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input class="form-control" type="email" name="email" value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Password <span class="text-danger">*</span></label>
                            <input class="form-control" type="password" name="password" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Age</label>
                            <input class="form-control" type="number" name="age" value="{{ old('age') }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Phone</label>
                            <input class="form-control" type="text" name="phone" value="{{ old('phone') }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Blood Type</label>
                            <select class="form-control" name="blood_type">
                                <option value="">Select</option>
                                @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $bt)
                                    <option value="{{ $bt }}" {{ old('blood_type') == $bt ? 'selected' : '' }}>{{ $bt }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Emergency Contact</label>
                            <input class="form-control" type="text" name="emergency_contact" value="{{ old('emergency_contact') }}">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" name="address" rows="2">{{ old('address') }}</textarea>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Medical History</label>
                            <textarea class="form-control" name="medical_history" rows="3">{{ old('medical_history') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="m-t-20 text-center">
                    <button type="submit" class="btn btn-primary submit-btn">Create Patient</button>
                    <a href="{{ route('patients.index') }}" class="btn btn-secondary submit-btn">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
