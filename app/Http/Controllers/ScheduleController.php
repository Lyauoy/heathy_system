<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Doctor;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of schedules.
     */
    public function index()
    {
        $schedules = Schedule::with('doctor.user')->orderBy('day', 'asc')->get();
        return view('schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new schedule.
     */
    public function create()
    {
        $doctors = Doctor::with('user')->get();
        return view('schedules.create', compact('doctors'));
    }

    /**
     * Store a newly created schedule.
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'day' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'nullable|string',
        ]);

        Schedule::create($request->all());

        return redirect()->route('schedules.index')->with('success', 'Schedule created successfully!');
    }

    /**
     * Show the form for editing the specified schedule.
     */
    public function edit(Schedule $schedule)
    {
        $doctors = Doctor::with('user')->get();
        return view('schedules.edit', compact('schedule', 'doctors'));
    }

    /**
     * Update the specified schedule.
     */
    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'day' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'nullable|string',
        ]);

        $schedule->update($request->all());

        return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully!');
    }

    /**
     * Remove the specified schedule.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'Schedule deleted successfully!');
    }
}
