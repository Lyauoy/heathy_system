@extends('layouts.app')

@section('title', 'Employees - SU30+')

@section('content')
<div class="content">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-sm-4 col-3"><h4 class="page-title">Employees</h4></div>
        <div class="col-sm-8 col-9 text-right m-b-20">
            <a href="{{ route('employees.create') }}" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Employee</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Employee ID</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Phone</th>
                            <th>Hire Date</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $employee)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img width="28" height="28" src="{{ asset('assets/img/user.jpg') }}" class="rounded-circle m-r-5" alt="">
                                {{ $employee->user->name ?? 'N/A' }}
                            </td>
                            <td>{{ $employee->employee_id ?? '-' }}</td>
                            <td>{{ $employee->department->name ?? '-' }}</td>
                            <td>{{ $employee->position ?? '-' }}</td>
                            <td>{{ $employee->phone ?? '-' }}</td>
                            <td>{{ $employee->hire_date ? $employee->hire_date->format('M d, Y') : '-' }}</td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ route('employees.edit', $employee) }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                        <a class="dropdown-item delete-btn" href="#" data-toggle="modal" data-target="#deleteModal" data-id="{{ $employee->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="8" class="text-center">No employees found</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content">
    <form id="deleteForm" method="POST">@csrf @method('DELETE')
        <div class="modal-body text-center"><h4>Delete this employee?</h4></div>
        <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>
        </div>
    </form>
</div></div></div>
@endsection

@push('scripts')
<script>
$('#deleteModal').on('show.bs.modal', function(e) {
    $(this).find('#deleteForm').attr('action', '{{ url("employees") }}/' + $(e.relatedTarget).data('id'));
});
</script>
@endpush
