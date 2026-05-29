@extends('layouts.app')

@section('title', 'Patient Profile - SU30+')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-7 col-6">
            <h4 class="page-title">Patient Profile</h4>
        </div>
        <div class="col-sm-5 col-6 text-right m-b-30">
            <a href="{{ route('patients.edit', $patient) }}" class="btn btn-primary btn-rounded"><i class="fa fa-pencil"></i> Edit</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="{{ asset('assets/img/user.jpg') }}" alt="" class="rounded-circle" width="150">
                    <h3 class="mt-3">{{ $patient->user->name ?? 'N/A' }}</h3>
                    <p class="text-muted">{{ $patient->user->email ?? '' }}</p>
                </div>
                <div class="col-md-8">
                    <ul class="personal-info">
                        <li><span class="title">Age:</span> <span class="text">{{ $patient->age ?? 'N/A' }}</span></li>
                        <li><span class="title">Phone:</span> <span class="text">{{ $patient->phone ?? 'N/A' }}</span></li>
                        <li><span class="title">Blood Type:</span> <span class="text">{{ $patient->blood_type ?? 'N/A' }}</span></li>
                        <li><span class="title">Address:</span> <span class="text">{{ $patient->address ?? 'N/A' }}</span></li>
                        <li><span class="title">Emergency Contact:</span> <span class="text">{{ $patient->emergency_contact ?? 'N/A' }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @if($patient->medical_history)
    <div class="card">
        <div class="card-header"><h4 class="card-title">Medical History</h4></div>
        <div class="card-body"><p>{{ $patient->medical_history }}</p></div>
    </div>
    @endif

    <div class="card">
        <div class="card-header"><h4 class="card-title d-inline-block">Appointments</h4></div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr><th>Doctor</th><th>Date</th><th>Status</th><th>Reason</th></tr>
                    </thead>
                    <tbody>
                        @forelse($patient->appointments as $apt)
                        <tr>
                            <td>Dr. {{ $apt->doctor->user->name ?? 'N/A' }}</td>
                            <td>{{ $apt->appointment_date->format('M d, Y h:i A') }}</td>
                            <td><span class="badge badge-{{ $apt->status == 'completed' ? 'success' : ($apt->status == 'pending' ? 'warning' : 'info') }}">{{ ucfirst($apt->status) }}</span></td>
                            <td>{{ $apt->reason_for_visit ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center">No appointments found</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
