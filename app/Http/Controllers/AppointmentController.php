<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Department;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of appointments.
     */
    public function index()
    {
        $appointments = Appointment::with(['patient.user', 'doctor.user', 'department'])
            ->orderBy('appointment_date', 'desc')
            ->get();

        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new appointment.
     */
    public function create()
    {
        $doctors = Doctor::with('user')->get();
        $patients = Patient::with('user')->get();
        $departments = Department::all();

        return view('appointments.create', compact('doctors', 'patients', 'departments'));
    }

    /**
     * Store a newly created appointment.
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'department_id' => 'required|exists:departments,id',
            'appointment_date' => 'required|date',
            'reason_for_visit' => 'nullable|string',
            'notes' => 'nullable|string',
            'status' => 'nullable|string|in:pending,confirmed,completed,cancelled',
        ]);

        Appointment::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'department_id' => $request->department_id,
            'appointment_date' => $request->appointment_date,
            'reason_for_visit' => $request->reason_for_visit,
            'notes' => $request->notes,
            'status' => $request->status ?? 'pending',
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully!');
    }

    /**
     * Display the specified appointment.
     */
    public function show(Appointment $appointment)
    {
        $appointment->load(['patient.user', 'doctor.user', 'department']);
        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified appointment.
     */
    public function edit(Appointment $appointment)
    {
        $doctors = Doctor::with('user')->get();
        $patients = Patient::with('user')->get();
        $departments = Department::all();

        return view('appointments.edit', compact('appointment', 'doctors', 'patients', 'departments'));
    }

    /**
     * Update the specified appointment.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'department_id' => 'required|exists:departments,id',
            'appointment_date' => 'required|date',
            'reason_for_visit' => 'nullable|string',
            'notes' => 'nullable|string',
            'status' => 'required|string|in:pending,confirmed,completed,cancelled',
        ]);

        $appointment->update($request->all());

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully!');
    }

    /**
     * Remove the specified appointment.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully!');
    }
}
