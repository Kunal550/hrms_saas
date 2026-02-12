@extends('layouts.app')

@section('content')
<h3>Leaves</h3>

@if(auth()->user()->role == 'admin')
<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Employee</th>
            <th>Type</th>
            <th>From</th>
            <th>To</th>
            <th>Reason</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($leaves as $leave)
        <tr>
            <td>{{ $leave->employee->name }}</td>
            <td>{{ $leave->leave_type }}</td>
            <td>{{ $leave->from_date->format('Y-m-d') }}</td>
            <td>{{ $leave->to_date->format('Y-m-d') }}</td>
            <td>{{ $leave->reason }}</td>
            <td>{{ ucfirst($leave->status) }}</td>
            <td>
                @if($leave->status == 'pending')
                <form method="POST" action="{{ route('leaves.approve',$leave->id) }}" class="d-inline">@csrf
                    <button class="btn btn-success btn-sm">Approve</button>
                </form>
                <form method="POST" action="{{ route('leaves.reject',$leave->id) }}" class="d-inline">@csrf
                    <button class="btn btn-danger btn-sm">Reject</button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<form method="POST" action="{{ route('leaves.store') }}">
    @csrf
    <input type="text" name="leave_type" placeholder="Leave Type" class="form-control mb-2" required>
    <input type="date" name="from_date" class="form-control mb-2" required>
    <input type="date" name="to_date" class="form-control mb-2" required>
    <textarea name="reason" class="form-control mb-2" placeholder="Reason" required></textarea>
    <button class="btn btn-primary">Apply Leave</button>
</form>

<h5 class="mt-4">Your Applied Leaves</h5>
<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Type</th>
            <th>From</th>
            <th>To</th>
            <th>Reason</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($leaves as $leave)
        <tr>
            <td>{{ $leave->leave_type }}</td>
            <td>{{ $leave->from_date->format('Y-m-d') }}</td>
            <td>{{ $leave->to_date->format('Y-m-d') }}</td>
            <td>{{ $leave->reason }}</td>
            <td>{{ ucfirst($leave->status) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

@endsection
