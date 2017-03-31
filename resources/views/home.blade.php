@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')

    You are logged in!
    <ul>
    @role('admin')

        <li><a href="/admin/users">Manage users</a></li>
        @role('owner')
        <li><a href="/admin/owner">Manage owner things</a></li>
        @endrole

    @endrole
    <li><a href="/courses">Courses</a></li>
    <li><a href="/tasks">Tasks</a></li>
    </ul>

@endsection
