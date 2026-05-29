@extends('layouts.app')

@section('title', 'Doctor Schedule - SU30+')

@section('content')
<div class="content">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-sm-4 col-3"><h4 class="page-title">Doctor Schedule</h4></div>
        <div class="col-sm-8 col-9 text-right m-b-20">
            <a href="{{ route('schedules.create') }}" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Schedule</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Doctor</th>
                            <th>Day</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($schedules as $schedule)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>Dr. {{ $schedule->doctor->user->name ?? 'N/A' }}</td>
                            <td>{{ $schedule->day }}</td>
                            <td>{{ $schedule->start_time }}</td>
                            <td>{{ $schedule->end_time }}</td>
                            <td><span class="badge badge-{{ ($schedule->status ?? 'active') == 'active' ? 'success' : 'secondary' }}">{{ ucfirst($schedule->status ?? 'active') }}</span></td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ route('schedules.edit', $schedule) }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                        <a class="dropdown-item delete-btn" href="#" data-toggle="modal" data-target="#deleteModal" data-id="{{ $schedule->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center">No schedules found</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content">
    <form id="deleteForm" method="POST">@csrf @method('DELETE')
        <div class="modal-body text-center"><h4>Delete this schedule?</h4></div>
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
    $(this).find('#deleteForm').attr('action', '{{ url("schedules") }}/' + $(e.relatedTarget).data('id'));
});
</script>
@endpush
