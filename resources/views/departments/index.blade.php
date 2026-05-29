@extends('layouts.app')

@section('title', 'Departments - SU30+')

@section('content')
<div class="content">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-sm-4 col-3"><h4 class="page-title">Departments</h4></div>
        <div class="col-sm-8 col-9 text-right m-b-20">
            <a href="#" class="btn btn-primary btn-rounded float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Add Department</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Department Name</th>
                            <th>Head</th>
                            <th>Description</th>
                            <th>Doctors</th>
                            <th>Employees</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($departments as $dept)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dept->name }}</td>
                            <td>{{ $dept->head ?? '-' }}</td>
                            <td>{{ Str::limit($dept->description, 50) ?? '-' }}</td>
                            <td>{{ $dept->doctors_count }}</td>
                            <td>{{ $dept->employees_count }}</td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item edit-btn" href="#" data-toggle="modal" data-target="#editModal"
                                           data-id="{{ $dept->id }}" data-name="{{ $dept->name }}" data-head="{{ $dept->head }}" data-description="{{ $dept->description }}">
                                            <i class="fa fa-pencil m-r-5"></i> Edit
                                        </a>
                                        <a class="dropdown-item delete-btn" href="#" data-toggle="modal" data-target="#deleteModal" data-id="{{ $dept->id }}">
                                            <i class="fa fa-trash-o m-r-5"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center">No departments found</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Add Modal --}}
<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content">
    <form action="{{ route('departments.store') }}" method="POST">
        @csrf
        <div class="modal-header"><h5 class="modal-title">Add Department</h5><button type="button" class="close" data-dismiss="modal">&times;</button></div>
        <div class="modal-body">
            <div class="form-group"><label>Name <span class="text-danger">*</span></label><input class="form-control" name="name" required></div>
            <div class="form-group"><label>Head</label><input class="form-control" name="head"></div>
            <div class="form-group"><label>Description</label><textarea class="form-control" name="description" rows="3"></textarea></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
    </form>
</div></div></div>

{{-- Edit Modal --}}
<div class="modal fade" id="editModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content">
    <form id="editForm" method="POST">
        @csrf @method('PUT')
        <div class="modal-header"><h5 class="modal-title">Edit Department</h5><button type="button" class="close" data-dismiss="modal">&times;</button></div>
        <div class="modal-body">
            <div class="form-group"><label>Name <span class="text-danger">*</span></label><input class="form-control" name="name" id="edit_name" required></div>
            <div class="form-group"><label>Head</label><input class="form-control" name="head" id="edit_head"></div>
            <div class="form-group"><label>Description</label><textarea class="form-control" name="description" id="edit_description" rows="3"></textarea></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div></div></div>

{{-- Delete Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content">
    <form id="deleteForm" method="POST">@csrf @method('DELETE')
        <div class="modal-body text-center"><h4>Delete this department?</h4></div>
        <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>
        </div>
    </form>
</div></div></div>
@endsection

@push('scripts')
<script>
$('#editModal').on('show.bs.modal', function(e) {
    var btn = $(e.relatedTarget);
    $(this).find('#editForm').attr('action', '{{ url("departments") }}/' + btn.data('id'));
    $(this).find('#edit_name').val(btn.data('name'));
    $(this).find('#edit_head').val(btn.data('head'));
    $(this).find('#edit_description').val(btn.data('description'));
});
$('#deleteModal').on('show.bs.modal', function(e) {
    $(this).find('#deleteForm').attr('action', '{{ url("departments") }}/' + $(e.relatedTarget).data('id'));
});
</script>
@endpush
