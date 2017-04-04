@extends('layouts.app')

@section('title')
    Course: {{$course->title}}
@endsection

@section('content')
  <div id="task">

    <task-list
      courseid="{{$course->id}}">
    </task-list>

  </div>

@endsection
