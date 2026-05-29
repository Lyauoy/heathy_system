@extends('layouts.app')
@section('title', 'Add Employee - SU30+')
@section('content')
<div class="content">
    <div class="row"><div class="col-sm-12"><h4 class="page-title">Add Employee</h4></div></div>
    @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form action="{{ route('employees.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-sm-6"><div class="form-group"><label>Full Name *</label><input class="form-control" name="name" value="{{ old('name') }}" required></div></div>
                    <div class="col-sm-6"><div class="form-group"><label>Username *</label><input class="form-control" name="username" value="{{ old('username') }}" required></div></div>
                    <div class="col-sm-6"><div class="form-group"><label>Email *</label><input class="form-control" type="email" name="email" value="{{ old('email') }}" required></div></div>
                    <div class="col-sm-6"><div class="form-group"><label>Password *</label><input class="form-control" type="password" name="password" required></div></div>
                    <div class="col-sm-6"><div class="form-group"><label>Department *</label>
                        <select class="form-control" name="department_id" required><option value="">Select</option>
                        @foreach($departments as $d)<option value="{{ $d->id }}" {{ old('department_id')==$d->id?'selected':'' }}>{{ $d->name }}</option>@endforeach</select></div></div>
                    <div class="col-sm-6"><div class="form-group"><label>Employee ID</label><input class="form-control" name="employee_id" value="{{ old('employee_id') }}"></div></div>
                    <div class="col-sm-6"><div class="form-group"><label>Position</label><input class="form-control" name="position" value="{{ old('position') }}"></div></div>
                    <div class="col-sm-6"><div class="form-group"><label>Phone</label><input class="form-control" name="phone" value="{{ old('phone') }}"></div></div>
                    <div class="col-sm-6"><div class="form-group"><label>Hire Date</label><input class="form-control" type="date" name="hire_date" value="{{ old('hire_date') }}"></div></div>
                    <div class="col-sm-6"><div class="form-group"><label>Salary</label><input class="form-control" type="number" step="0.01" name="salary" value="{{ old('salary') }}"></div></div>
                </div>
                <div class="m-t-20 text-center">
                    <button type="submit" class="btn btn-primary submit-btn">Create Employee</button>
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary submit-btn">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
