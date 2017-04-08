@extends('layouts.app')

@section('title')
    Course: {{$course->title}}
@endsection

@section('content')

    <task-list
      courseid="{{$course->id}}"
      url="{{url('/courses/' .$course->id .'/tasks')}}">
    </task-list>


@endsection
