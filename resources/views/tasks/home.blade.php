@extends('layouts.app')

@section('title')
    Tasks
@endsection

@section('content')
<ul>
    @foreach ($tasks as $task)
        <li><a href="/tasks/{{$task->id}}">{{$task->title}}</a>
        <a href="/tasks/{{$task->id}}/edit">Edit</a></li>
    @endforeach
</ul>
    
    This is the 'tasks' page
<ul>
    <li><a href="/tasks/1/edit">edit</a></li>
    <li><a href="/tasks/create">create</a></li>
    <li><a href="/tasks/1">1</a></li>
</ul>    
@endsection
