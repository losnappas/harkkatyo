@extends('layouts.app')

@section('title')
    Course title: {{$course->title}}
@endsection

@section('content')

    {{$course->body}}
    <br /><br />
    Tasks:
    <ul>
        @foreach($course->tasks as $task)
            <li>{{$task->title}}</li>
        @endforeach
    </ul>

@endsection
