<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    /**
     * Display a listing of doctors.
     */
    public function index()
    {
        $doctors = Doctor::with(['user', 'department'])->orderBy('id', 'asc')->get();
        return view('doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new doctor.
     */
    public function create()
    {
        $departments = Department::all();
        return view('doctors.create', compact('departments'));
    }

    /**
     * Store a newly created doctor.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'department_id' => 'required|exists:departments,id',
            'specialization' => 'nullable|string|max:255',
            'license_number' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
        ]);

        // Create user account for the doctor
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2, // Doctor role
        ]);

        // Create doctor profile
        $doctor = Doctor::create([
            'user_id' => $user->id,
            'department_id' => $request->department_id,
            'specialization' => $request->specialization,
            'license_number' => $request->license_number,
            'phone' => $request->phone,
            'bio' => $request->bio,
        ]);

        return redirect()->route('doctors.index')->with('success', 'Doctor added successfully!');
    }

    /**
     * Display the specified doctor.
     */
    public function show(Doctor $doctor)
    {
        $doctor->load(['user', 'department', 'appointments.patient.user', 'schedules']);
        return view('doctors.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified doctor.
     */
    public function edit(Doctor $doctor)
    {
        $doctor->load('user');
        $departments = Department::all();
        return view('doctors.edit', compact('doctor', 'departments'));
    }

    /**
     * Update the specified doctor.
     */
    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $doctor->user_id,
            'department_id' => 'required|exists:departments,id',
            'specialization' => 'nullable|string|max:255',
            'license_number' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
        ]);

        // Update user info
        $doctor->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update doctor profile
        $doctor->update([
            'department_id' => $request->department_id,
            'specialization' => $request->specialization,
            'license_number' => $request->license_number,
            'phone' => $request->phone,
            'bio' => $request->bio,
        ]);

        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully!');
    }

    /**
     * Remove the specified doctor.
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->user->delete();
        $doctor->delete();

        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully!');
    }
}
