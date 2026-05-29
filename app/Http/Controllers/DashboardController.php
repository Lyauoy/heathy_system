<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function index()
    {
        $user = auth()->user();
        $role = $user->role->name ?? '';

        if ($role === 'doctor') {
            $doctor = $user->doctor;
            
            $doctorsCount = Doctor::count(); // Still useful to see team size
            $patientsCount = Appointment::where('doctor_id', $doctor->id)->distinct('patient_id')->count();
            $appointmentsCount = Appointment::where('doctor_id', $doctor->id)->count();
            $pendingAppointments = Appointment::where('doctor_id', $doctor->id)->where('status', 'pending')->count();

            $upcomingAppointments = Appointment::with(['patient.user', 'doctor.user'])
                ->where('doctor_id', $doctor->id)
                ->where('status', '!=', 'completed')
                ->orderBy('appointment_date', 'asc')
                ->take(5)
                ->get();

            $newPatients = Patient::whereHas('appointments', function($q) use ($doctor) {
                    $q->where('doctor_id', $doctor->id);
                })
                ->with('user')
                ->latest()
                ->take(5)
                ->get();

            $recentDoctors = Doctor::with('user')->latest()->take(6)->get();
        } else {
            // Admin or Employee (Global stats)
            $doctorsCount = Doctor::count();
            $patientsCount = Patient::count();
            $appointmentsCount = Appointment::count();
            $pendingAppointments = Appointment::where('status', 'pending')->count();

            $upcomingAppointments = Appointment::with(['patient.user', 'doctor.user'])
                ->where('status', '!=', 'completed')
                ->orderBy('appointment_date', 'asc')
                ->take(5)
                ->get();

            $newPatients = Patient::with('user')->latest()->take(5)->get();
            $recentDoctors = Doctor::with('user')->latest()->take(6)->get();
        }

        return view('dashboard', compact(
            'doctorsCount',
            'patientsCount',
            'appointmentsCount',
            'pendingAppointments',
            'upcomingAppointments',
            'newPatients',
            'recentDoctors'
        ));
    }
}
