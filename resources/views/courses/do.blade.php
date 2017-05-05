@extends('layouts.app')

@section('title')
    Course: {{$course->title}}
@endsection

@section('content')

    <task-list
      courseid="{{$course->id}}"
      sessionid="{{$session->id}}">
    </task-list>
      <!-- url="{{url('/courses/' .$course->id .'/tasks')}}" --> 


@endsection
