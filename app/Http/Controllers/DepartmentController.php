<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of departments.
     */
    public function index()
    {
        $departments = Department::withCount(['doctors', 'employees'])->get();
        return view('departments.index', compact('departments'));
    }

    /**
     * Store a newly created department.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments',
            'description' => 'nullable|string',
            'head' => 'nullable|string|max:255',
        ]);

        Department::create($request->all());

        return redirect()->route('departments.index')->with('success', 'Department added successfully!');
    }

    /**
     * Update the specified department.
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name,' . $department->id,
            'description' => 'nullable|string',
            'head' => 'nullable|string|max:255',
        ]);

        $department->update($request->all());

        return redirect()->route('departments.index')->with('success', 'Department updated successfully!');
    }

    /**
     * Remove the specified department.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully!');
    }
}
