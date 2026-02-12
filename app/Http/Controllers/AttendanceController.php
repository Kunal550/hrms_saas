<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if($user->role == 'admin'){
            $attendances = Attendance::with('employee')->orderBy('date','desc')->get();
            $todayAttendance = null;
        } else {
            $employee = $user->employee;
            if(!$employee) return back()->with('error','Employee record not found');

            $attendances = Attendance::where('employee_id', $employee->id)
                ->orderBy('date','desc')
                ->get();

            $todayAttendance = Attendance::where('employee_id', $employee->id)
                ->whereDate('date', today())
                ->first();
        }

        return view('attendance.index', compact('attendances','todayAttendance'));
    }

    public function clockIn()
    {
        $employee = auth()->user()->employee;
        if(!$employee) return back()->with('error','Employee profile not found');

        $exists = Attendance::where('employee_id', $employee->id)
            ->whereDate('date', today())
            ->exists();

        if($exists) return back()->with('success','Already clocked in today');

        Attendance::create([
            'employee_id' => $employee->id,
            'company_id' => $employee->company_id,
            'date' => today(),
            'clock_in' => now(),
        ]);

        return back()->with('success','Clocked In Successfully');
    }

    public function clockOut()
    {
        $employee = auth()->user()->employee;
        if(!$employee) return back()->with('error','Employee profile not found');

        $attendance = Attendance::where('employee_id', $employee->id)
            ->whereDate('date', today())
            ->first();

        if(!$attendance) return back()->with('error','No clock-in found today');
        if($attendance->clock_out) return back()->with('success','Already clocked out today');

        $minutes = now()->diffInMinutes($attendance->clock_in);

        $attendance->update([
            'clock_out' => now(),
            'total_hours' => round($minutes / 60, 2),
        ]);

        return back()->with('success','Clocked Out Successfully');
    }
}
