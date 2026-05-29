<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    /**
     * Display a listing of patients.
     */
    public function index()
    {
        $patients = Patient::with('user')->orderBy('id', 'asc')->get();
        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new patient.
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created patient.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'age' => 'nullable|integer',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'blood_type' => 'nullable|string|max:5',
            'medical_history' => 'nullable|string',
            'emergency_contact' => 'nullable|string|max:50',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 3, // Patient role
        ]);

        Patient::create([
            'user_id' => $user->id,
            'age' => $request->age,
            'phone' => $request->phone,
            'address' => $request->address,
            'blood_type' => $request->blood_type,
            'medical_history' => $request->medical_history,
            'emergency_contact' => $request->emergency_contact,
        ]);

        return redirect()->route('patients.index')->with('success', 'Patient added successfully!');
    }

    /**
     * Display the specified patient.
     */
    public function show(Patient $patient)
    {
        $patient->load(['user', 'appointments.doctor.user', 'invoices']);
        return view('patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified patient.
     */
    public function edit(Patient $patient)
    {
        $patient->load('user');
        return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified patient.
     */
    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $patient->user_id,
            'age' => 'nullable|integer',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'blood_type' => 'nullable|string|max:5',
            'medical_history' => 'nullable|string',
            'emergency_contact' => 'nullable|string|max:50',
        ]);

        $patient->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $patient->update([
            'age' => $request->age,
            'phone' => $request->phone,
            'address' => $request->address,
            'blood_type' => $request->blood_type,
            'medical_history' => $request->medical_history,
            'emergency_contact' => $request->emergency_contact,
        ]);

        return redirect()->route('patients.index')->with('success', 'Patient updated successfully!');
    }

    /**
     * Remove the specified patient.
     */
    public function destroy(Patient $patient)
    {
        $patient->user->delete();
        $patient->delete();

        return redirect()->route('patients.index')->with('success', 'Patient deleted successfully!');
    }
}
