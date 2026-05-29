@extends('layouts.app')

@section('title', 'Doctor Profile - SU30+')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-7 col-6">
            <h4 class="page-title">Doctor Profile</h4>
        </div>
        <div class="col-sm-5 col-6 text-right m-b-30">
            <a href="{{ route('doctors.edit', $doctor) }}" class="btn btn-primary btn-rounded">
                <i class="fa fa-pencil"></i> Edit
            </a>
        </div>
    </div>

    <div class="card-box profile-header">
        <div class="row">
            <div class="col-md-12">
                <div class="profile-view">
                    <div class="profile-img-wrap">
                        <div class="profile-img">
                            <a href="#">
                                <img class="avatar" src="{{ $doctor->profile_photo_path ? asset('storage/' . $doctor->profile_photo_path) : asset('assets/img/user.jpg') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="profile-basic">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="profile-info-left">
                                    <h3 class="user-name m-t-0 mb-0">{{ $doctor->user->name ?? 'N/A' }}</h3>
                                    <small class="text-muted">{{ $doctor->department->name ?? '' }}</small>
                                    <div class="staff-id">Specialization: {{ $doctor->specialization ?? 'N/A' }}</div>
                                    <div class="staff-msg">
                                        <a href="#" class="btn btn-primary">Send Message</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <ul class="personal-info">
                                    <li>
                                        <span class="title">Phone:</span>
                                        <span class="text">{{ $doctor->phone ?? 'N/A' }}</span>
                                    </li>
                                    <li>
                                        <span class="title">Email:</span>
                                        <span class="text">{{ $doctor->user->email ?? 'N/A' }}</span>
                                    </li>
                                    <li>
                                        <span class="title">License No:</span>
                                        <span class="text">{{ $doctor->license_number ?? 'N/A' }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($doctor->bio)
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Biography</h4>
        </div>
        <div class="card-body">
            <p>{{ $doctor->bio }}</p>
        </div>
    </div>
    @endif

    {{-- Doctor's Appointments --}}
    <div class="card">
        <div class="card-header">
            <h4 class="card-title d-inline-block">Appointments</h4>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Reason</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($doctor->appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->patient->user->name ?? 'N/A' }}</td>
                            <td>{{ $appointment->appointment_date->format('M d, Y h:i A') }}</td>
                            <td>
                                <span class="badge badge-{{ $appointment->status == 'completed' ? 'success' : ($appointment->status == 'pending' ? 'warning' : 'info') }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                            <td>{{ $appointment->reason_for_visit ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No appointments found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Doctor's Schedule --}}
    <div class="card">
        <div class="card-header">
            <h4 class="card-title d-inline-block">Schedule</h4>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($doctor->schedules as $schedule)
                        <tr>
                            <td>{{ $schedule->day }}</td>
                            <td>{{ $schedule->start_time }}</td>
                            <td>{{ $schedule->end_time }}</td>
                            <td>{{ ucfirst($schedule->status ?? 'active') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No schedule found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
