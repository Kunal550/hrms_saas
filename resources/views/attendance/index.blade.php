@extends('layouts.app')

@section('content')
<h3>Attendance</h3>

@if(auth()->user()->role == 'admin')
<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Employee</th>
            <th>Date</th>
            <th>Clock In</th>
            <th>Clock Out</th>
            <th>Total Hours</th>
        </tr>
    </thead>
    <tbody>
        @foreach($attendances as $att)
        <tr>
            <td>{{ $att->employee->name }}</td>
            <td>{{ $att->date ? $att->date->format('Y-m-d') : '-' }}</td>
            <td>{{ $att->clock_in ? $att->clock_in->format('H:i') : '-' }}</td>
            <td>{{ $att->clock_out ? $att->clock_out->format('H:i') : '-' }}</td>
            <td>{{ $att->total_hours ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="mb-3">
    <form method="POST" action="{{ route('attendance.clockIn') }}">
        @csrf
        <button type="submit" class="btn btn-primary"
            @if($todayAttendance && $todayAttendance->clock_in) disabled @endif>Clock In</button>
    </form>
    <form method="POST" action="{{ route('attendance.clockOut') }}" class="mt-2">
        @csrf
        <button type="submit" class="btn btn-success"
            @if(!$todayAttendance || $todayAttendance->clock_out) disabled @endif>Clock Out</button>
    </form>
</div>

<h5>Your Attendance Records</h5>
<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Date</th>
            <th>Clock In</th>
            <th>Clock Out</th>
            <th>Total Hours</th>
        </tr>
    </thead>
    <tbody>
        @foreach($attendances as $att)
        <tr>
            <td>{{ $att->date ? $att->date->format('Y-m-d') : '-' }}</td>
            <td>{{ $att->clock_in ? $att->clock_in->format('H:i') : '-' }}</td>
            <td>{{ $att->clock_out ? $att->clock_out->format('H:i') : '-' }}</td>
            <td>{{ $att->total_hours ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection
