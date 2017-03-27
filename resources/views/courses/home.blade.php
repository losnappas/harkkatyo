@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Courses</div>
                
                <div class="panel-body">
                This is the 'courses' page
                <ul>
                <li><a href="courses/1/edit">edit</a></li>
                <li><a href="courses/create">create</a></li>
                <li><a href="courses/1">1</a></li>
                </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
