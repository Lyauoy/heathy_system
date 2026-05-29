@extends('layouts.app')

@section('title', 'Dashboard - SU30+')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
                <span class="dash-widget-bg1"><i class="fa fa-stethoscope" aria-hidden="true"></i></span>
                <div class="dash-widget-info text-right">
                    <h3>{{ $doctorsCount }}</h3>
                    <span class="widget-title1">Doctors <i class="fa fa-check" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
                <span class="dash-widget-bg2"><i class="fa fa-user-o"></i></span>
                <div class="dash-widget-info text-right">
                    <h3>{{ $patientsCount }}</h3>
                    <span class="widget-title2">{{ auth()->user()->role->name === 'doctor' ? 'My Patients' : 'Patients' }} <i class="fa fa-check" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
                <span class="dash-widget-bg3"><i class="fa fa-user-md" aria-hidden="true"></i></span>
                <div class="dash-widget-info text-right">
                    <h3>{{ $appointmentsCount }}</h3>
                    <span class="widget-title3">{{ auth()->user()->role->name === 'doctor' ? 'My Appointments' : 'Appointments' }} <i class="fa fa-check" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
                <span class="dash-widget-bg4"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
                <div class="dash-widget-info text-right">
                    <h3>{{ $pendingAppointments }}</h3>
                    <span class="widget-title4">Pending <i class="fa fa-check" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
    </div>

    {{-- Upcoming for Appointments & Doctor --}}
    <div class="row">
        <div class="col-12 col-md-6 col-lg-8 col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title d-inline-block">{{ auth()->user()->role->name === 'doctor' ? 'My Upcoming Appointments' : 'Upcoming Appointments' }}</h4>
                    <a href="{{ route('appointments.index') }}" class="btn btn-primary float-right">View all</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="d-none">
                                <tr>
                                    <th>Patient Name</th>
                                    <th>Doctor Name</th>
                                    <th>Timing</th>
                                    <th class="text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($upcomingAppointments as $appointment)
                                <tr>
                                    <td style="min-width: 200px;">
                                        <a class="avatar" href="#">{{ substr($appointment->patient->user->name ?? 'N', 0, 1) }}</a>
                                        <h2><a href="#">{{ $appointment->patient->user->name ?? 'N/A' }} <span>{{ $appointment->patient->address ?? '' }}</span></a></h2>
                                    </td>
                                    <td>
                                        <h5 class="time-title p-0">Appointment With</h5>
                                        <p>Dr. {{ $appointment->doctor->user->name ?? 'N/A' }}</p>
                                    </td>
                                    <td>
                                        <h5 class="time-title p-0">Timing</h5>
                                        <p>{{ $appointment->appointment_date->format('h:i A') }}</p>
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('appointments.show', $appointment) }}" class="btn btn-outline-primary take-btn">View</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">No upcoming appointments</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 col-xl-4">
            <div class="card member-panel">
                <div class="card-header bg-white">
                    <h4 class="card-title mb-0">Doctors</h4>
                </div>
                <div class="card-body">
                    <ul class="contact-list">
                        @forelse($recentDoctors as $doctor)
                        <li>
                            <div class="contact-cont">
                                <div class="float-left user-img m-r-10">
                                    <a href="{{ route('doctors.show', $doctor) }}" title="{{ $doctor->user->name ?? '' }}">
                                        <img src="{{ asset('assets/img/user.jpg') }}" alt="" class="w-40 rounded-circle">
                                        <span class="status online"></span>
                                    </a>
                                </div>
                                <div class="contact-info">
                                    <span class="contact-name text-ellipsis">{{ $doctor->user->name ?? 'N/A' }}</span>
                                    <span class="contact-date">{{ $doctor->specialization ?? 'General' }}</span>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="text-center">No doctors found</li>
                        @endforelse
                    </ul>
                </div>
                <div class="card-footer text-center bg-white">
                    <a href="{{ route('doctors.index') }}" class="text-muted">View all Doctors</a>
                </div>
            </div>
        </div>
    </div>

    {{-- New Patients --}}
    <div class="row">
        <div class="col-12 col-md-6 col-lg-8 col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title d-inline-block">{{ auth()->user()->role->name === 'doctor' ? 'My New Patients' : 'New Patients' }}</h4>
                    <a href="{{ route('patients.index') }}" class="btn btn-primary float-right">View all</a>
                </div>
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="table mb-0 new-patient-table">
                            <tbody>
                                @forelse($newPatients as $patient)
                                <tr>
                                    <td>
                                        <img width="28" height="28" class="rounded-circle" src="{{ asset('assets/img/user.jpg') }}" alt="">
                                        <h2>{{ $patient->user->name ?? 'N/A' }}</h2>
                                    </td>
                                    <td>{{ $patient->user->email ?? 'N/A' }}</td>
                                    <td>{{ $patient->phone ?? 'N/A' }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-primary-one float-right">
                                            {{ $patient->blood_type ?? 'N/A' }}
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">No patients found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 col-xl-4">
            <div class="hospital-barchart">
                <h4 class="card-title d-inline-block">Hospital Management</h4>
            </div>
            <div class="bar-chart">
                <div class="legend">
                    <div class="item"><h4>Level1</h4></div>
                    <div class="item"><h4>Level2</h4></div>
                    <div class="item text-right"><h4>Level3</h4></div>
                    <div class="item text-right"><h4>Level4</h4></div>
                </div>
                <div class="chart clearfix">
                    <div class="item">
                        <div class="bar">
                            <span class="percent">16%</span>
                            <div class="item-progress" data-percent="16">
                                <span class="title">OPD Patient</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="bar">
                            <span class="percent">71%</span>
                            <div class="item-progress" data-percent="71">
                                <span class="title">New Patient</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="bar">
                            <span class="percent">82%</span>
                            <div class="item-progress" data-percent="82">
                                <span class="title">Laboratory Test</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="bar">
                            <span class="percent">67%</span>
                            <div class="item-progress" data-percent="67">
                                <span class="title">Treatment</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="bar">
                            <span class="percent">30%</span>
                            <div class="item-progress" data-percent="30">
                                <span class="title">Discharge</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
