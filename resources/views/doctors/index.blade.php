@extends('layouts.app')

@section('title', 'Doctors - SU30+')

@section('content')
<div class="content">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">Doctors</h4>
        </div>
        <div class="col-sm-8 col-9 text-right m-b-20">
            <a href="{{ route('doctors.create') }}" class="btn btn-primary btn-rounded float-right">
                <i class="fa fa-plus"></i> Add Doctor
            </a>
        </div>
    </div>

    <div class="row doctor-grid">
        @forelse($doctors as $doctor)
        <div class="col-md-4 col-sm-4 col-lg-3">
            <div class="profile-widget">
                <div class="doctor-img">
                    <a class="avatar" href="{{ route('doctors.show', $doctor) }}">
                        <img alt="" src="{{ $doctor->profile_photo_path ? asset('storage/' . $doctor->profile_photo_path) : asset('assets/img/user.jpg') }}">
                    </a>
                </div>

                {{-- Dropdown --}}
                <div class="dropdown profile-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('doctors.edit', $doctor) }}">
                            <i class="fa fa-pencil m-r-5"></i> Edit
                        </a>
                        <a class="dropdown-item delete-btn" href="#"
                           data-toggle="modal"
                           data-target="#deleteDoctorModal"
                           data-id="{{ $doctor->id }}">
                            <i class="fa fa-trash-o m-r-5"></i> Delete
                        </a>
                    </div>
                </div>

                <h4 class="doctor-name text-ellipsis">
                    <a href="{{ route('doctors.show', $doctor) }}">{{ $doctor->user->name ?? 'N/A' }}</a>
                </h4>
                <div class="doc-prof">{{ $doctor->department->name ?? '' }}</div>
                <div class="user-country">
                    <i class="fa fa-map-marker"></i> {{ $doctor->specialization ?? 'General' }}
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <h5 class="text-center">No Doctors Found</h5>
        </div>
        @endforelse
    </div>
</div>

{{-- Delete Modal --}}
<div class="modal fade" id="deleteDoctorModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="deleteDoctorForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title">Delete Doctor</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this doctor?
                </div>
                <div class="modal-footer">
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
$('#deleteDoctorModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var doctorId = button.data('id');
    var action = '{{ url("doctors") }}/' + doctorId;
    $(this).find('#deleteDoctorForm').attr('action', action);
});
</script>
@endpush
