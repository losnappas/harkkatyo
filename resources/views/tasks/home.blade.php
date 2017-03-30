@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Tasks</div>
                <div class="panel-body">
                <ul>
                @foreach ($tasks as $task)
                    <li><a href="/tasks/{{$task->id}}">{{$task->title}}</a></li>
                @endforeach
                </ul>
                
                This is the 'tasks' page
                <ul>
                <li><a href="/tasks/1/edit">edit</a></li>
                <li><a href="/tasks/create">create</a></li>
                <li><a href="/tasks/1">1</a></li>
                </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
