<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of employees.
     */
    public function index()
    {
        $employees = Employee::with(['user', 'department'])->orderBy('id', 'asc')->get();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new employee.
     */
    public function create()
    {
        $departments = Department::all();
        return view('employees.create', compact('departments'));
    }

    /**
     * Store a newly created employee.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'department_id' => 'required|exists:departments,id',
            'employee_id' => 'nullable|string|max:50',
            'position' => 'nullable|string|max:255',
            'hire_date' => 'nullable|date',
            'salary' => 'nullable|numeric',
            'phone' => 'nullable|string|max:20',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 4, // Employee role
        ]);

        Employee::create([
            'user_id' => $user->id,
            'department_id' => $request->department_id,
            'employee_id' => $request->employee_id,
            'position' => $request->position,
            'hire_date' => $request->hire_date,
            'salary' => $request->salary,
            'phone' => $request->phone,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee added successfully!');
    }

    /**
     * Show the form for editing the specified employee.
     */
    public function edit(Employee $employee)
    {
        $employee->load('user');
        $departments = Department::all();
        return view('employees.edit', compact('employee', 'departments'));
    }

    /**
     * Update the specified employee.
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $employee->user_id,
            'department_id' => 'required|exists:departments,id',
            'position' => 'nullable|string|max:255',
            'hire_date' => 'nullable|date',
            'salary' => 'nullable|numeric',
            'phone' => 'nullable|string|max:20',
        ]);

        $employee->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $employee->update([
            'department_id' => $request->department_id,
            'position' => $request->position,
            'hire_date' => $request->hire_date,
            'salary' => $request->salary,
            'phone' => $request->phone,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
    }

    /**
     * Remove the specified employee.
     */
    public function destroy(Employee $employee)
    {
        $employee->user->delete();
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully!');
    }
}
