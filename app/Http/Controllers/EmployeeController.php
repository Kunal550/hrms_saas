<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('user')->where('company_id', auth()->user()->company_id)->get();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'employee_code' => 'required|unique:employees,employee_code',
            'department' => 'required|string|max:100',
            'date_of_joining' => 'required|date',
        ]);
        $company_id = auth()->user()->company_id;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'employee',
            'company_id' => $company_id
        ]);

        Employee::create([
            'user_id' => $user->id,
            'company_id' => auth()->user()->company_id ?? 1,
            'employee_code' => $request->employee_code,
            'name' => $request->name,
            'email' => $request->email,
            'department' => $request->department,
            'date_of_joining' => $request->date_of_joining,
            'status' => 'active',
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee Added Successfully');
    }
}
