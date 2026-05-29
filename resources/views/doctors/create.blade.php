@extends('layouts.app')

@section('title', 'Add Doctor - SU30+')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Add Doctor</h4>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form action="{{ route('doctors.store') }}" method="POST">
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
                            <label>Department <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="department_id" required>
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Specialization</label>
                            <input class="form-control" type="text" name="specialization" value="{{ old('specialization') }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>License Number</label>
                            <input class="form-control" type="text" name="license_number" value="{{ old('license_number') }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Phone</label>
                            <input class="form-control" type="text" name="phone" value="{{ old('phone') }}">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Biography</label>
                            <textarea class="form-control" name="bio" rows="3">{{ old('bio') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="m-t-20 text-center">
                    <button type="submit" class="btn btn-primary submit-btn">Create Doctor</button>
                    <a href="{{ route('doctors.index') }}" class="btn btn-secondary submit-btn">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
