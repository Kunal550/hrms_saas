@extends('layouts.app')

@section('content')
<h3>Add Employee</h3>

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('employees.store') }}">
    @csrf
    <input type="text" name="name" placeholder="Name" class="form-control mb-2" required>
    <input type="email" name="email" placeholder="Email" class="form-control mb-2" required>
    <input type="password" name="password" placeholder="Password" class="form-control mb-2" required>
    <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control mb-2" required>
    <input type="text" name="employee_code" placeholder="Employee Code" class="form-control mb-2" required>
    <input type="text" name="department" placeholder="Department" class="form-control mb-2" required>
    <input type="date" name="date_of_joining" class="form-control mb-2" required>
    <button type="submit" class="btn btn-success">Add Employee</button>
</form>
@endsection