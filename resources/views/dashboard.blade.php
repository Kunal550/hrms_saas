@extends('layouts.app')

@section('content')
<h2>Welcome, {{ auth()->user()->name }}</h2>
<p>Select a module from the left menu to start.</p>
@endsection
