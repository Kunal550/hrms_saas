<?php

namespace App\Http\Controllers;

use App\Models\LeaveModel;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role == 'admin') {
            $leaves = LeaveModel::with('employee')->orderBy('created_at','desc')->get();
        } else {
            $employee = $user->employee;
            if (!$employee) return back()->with('error','Employee profile not found');

            $leaves = LeaveModel::where('employee_id', $employee->id)
                ->orderBy('created_at','desc')
                ->get();
        }

        return view('leaves.index', compact('leaves'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'leave_type' => 'required',
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'reason' => 'required'
        ]);

        $employee = auth()->user()->employee;
        if (!$employee) return back()->with('error','Employee profile not found');

        LeaveModel::create([
            'employee_id' => $employee->id,
            'company_id' => $employee->company_id,
            'leave_type' => $request->leave_type,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'reason' => $request->reason
        ]);

        return back()->with('success','Leave Applied Successfully');
    }

    public function approve(LeaveModel $leave)
    {
        $leave->update(['status' => 'approved']);
        return back()->with('success','Leave Approved');
    }

    public function reject(LeaveModel $leave)
    {
        $leave->update(['status' => 'rejected']);
        return back()->with('success','Leave Rejected');
    }
}
