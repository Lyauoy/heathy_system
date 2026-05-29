@extends('layouts.app')

@section('title', 'Appointment Details - SU30+')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-7 col-6"><h4 class="page-title">Appointment Details</h4></div>
        <div class="col-sm-5 col-6 text-right">
            <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-primary btn-rounded"><i class="fa fa-pencil"></i> Edit</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Patient Information</h5>
                    <ul class="personal-info">
                        <li><span class="title">Name:</span> <span class="text">{{ $appointment->patient->user->name ?? 'N/A' }}</span></li>
                        <li><span class="title">Phone:</span> <span class="text">{{ $appointment->patient->phone ?? 'N/A' }}</span></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5>Doctor Information</h5>
                    <ul class="personal-info">
                        <li><span class="title">Doctor:</span> <span class="text">Dr. {{ $appointment->doctor->user->name ?? 'N/A' }}</span></li>
                        <li><span class="title">Department:</span> <span class="text">{{ $appointment->department->name ?? 'N/A' }}</span></li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <ul class="personal-info">
                        <li><span class="title">Date & Time:</span> <span class="text">{{ $appointment->appointment_date->format('M d, Y h:i A') }}</span></li>
                        <li><span class="title">Status:</span> <span class="text"><span class="badge badge-{{ $appointment->status == 'completed' ? 'success' : ($appointment->status == 'pending' ? 'warning' : 'info') }}">{{ ucfirst($appointment->status) }}</span></span></li>
                        <li><span class="title">Reason:</span> <span class="text">{{ $appointment->reason_for_visit ?? '-' }}</span></li>
                        <li><span class="title">Notes:</span> <span class="text">{{ $appointment->notes ?? '-' }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
