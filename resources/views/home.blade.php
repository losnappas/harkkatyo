@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                    <ul>
                    @role('admin')
                    
                        <li><a href="/admin/user">Manage users</a></li>
                        @role('owner')
                        <li><a href="/admin/owner">Manage owner things</a></li>
                        @endrole
                    
                    @endrole
                    <li><a href="/courses">Courses</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
