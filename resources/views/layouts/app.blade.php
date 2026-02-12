<!DOCTYPE html>
<html>
<head>
    <title>HRMS SaaS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}">HRMS SaaS</a>
        <span class="navbar-text text-white">
            {{ auth()->user()->name }} ({{ auth()->user()->role }})
        </span>
        <a class="btn btn-danger" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
           Logout
        </a>
    </div>
</nav>

<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-2 bg-light vh-100 p-3">
            <h5>Modules</h5>
            <ul class="nav flex-column">
                @if(auth()->user()->role == 'admin')
                <li class="nav-item"><a href="{{ route('employees.index') }}" class="nav-link">Employees</a></li>
                <li class="nav-item"><a href="{{ route('attendance.index') }}" class="nav-link">Attendance</a></li>
                <li class="nav-item"><a href="{{ route('leaves.index') }}" class="nav-link">Leaves</a></li>
                @else
                <li class="nav-item"><a href="{{ route('attendance.index') }}" class="nav-link">My Attendance</a></li>
                <li class="nav-item"><a href="{{ route('leaves.index') }}" class="nav-link">My Leaves</a></li>
                @endif
            </ul>
        </div>

        <div class="col-10">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

<form id="logout-form" method="POST" action="{{ route('logout') }}">@csrf</form>

</body>
</html>
