@extends('layouts.app')

@section('title', 'Patients - SU30+')

@section('content')
<div class="content">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">Patients</h4>
        </div>
        <div class="col-sm-8 col-9 text-right m-b-20">
            <a href="{{ route('patients.create') }}" class="btn btn-primary btn-rounded float-right">
                <i class="fa fa-plus"></i> Add Patient
            </a>
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
                            <th>Age</th>
                            <th>Phone</th>
                            <th>Blood Type</th>
                            <th>Address</th>
                            <th>Emergency Contact</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($patients as $patient)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img width="28" height="28" src="{{ asset('assets/img/user.jpg') }}" class="rounded-circle m-r-5" alt="">
                                <a href="{{ route('patients.show', $patient) }}">{{ $patient->user->name ?? 'N/A' }}</a>
                            </td>
                            <td>{{ $patient->age ?? '-' }}</td>
                            <td>{{ $patient->phone ?? '-' }}</td>
                            <td>{{ $patient->blood_type ?? '-' }}</td>
                            <td>{{ $patient->address ?? '-' }}</td>
                            <td>{{ $patient->emergency_contact ?? '-' }}</td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ route('patients.edit', $patient) }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                        <a class="dropdown-item delete-btn" href="#" data-toggle="modal" data-target="#deleteModal" data-id="{{ $patient->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="8" class="text-center">No patients found</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Delete Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="deleteForm" method="POST">
                @csrf @method('DELETE')
                <div class="modal-body text-center">
                    <h4>Are you sure you want to delete this patient?</h4>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$('#deleteModal').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('id');
    $(this).find('#deleteForm').attr('action', '{{ url("patients") }}/' + id);
});
</script>
@endpush
