@extends('layouts.app')

@section('content')
<h3>Employees</h3>

<a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Add Employee</a>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Employee Code</th>
            <th>Department</th>
            <th>Date of Joining</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employees as $emp)
        <tr>
            <td>{{ $emp->name }}</td>
            <td>{{ $emp->email }}</td>
            <td>{{ $emp->employee_code }}</td>
            <td>{{ $emp->department }}</td>
            <td>{{ $emp->date_of_joining->format('Y-m-d') }}</td>
            <td>{{ ucfirst($emp->status) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
