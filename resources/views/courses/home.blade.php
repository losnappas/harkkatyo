@extends('layouts.app')

@section('title')
    Courses
@endsection

@section('content')

    <ul>
        @foreach ($courses as $course)
            <li><a href="/courses/{{$course->id}}">{{$course->title}}</a>
            <a href="/courses/{{$course->id}}/edit">Edit</a></li>
        @endforeach
    </ul>
    
    This is the 'courses' page
    <ul>
        <li><a href="{{url('courses/1/edit')}}">edit</a></li>
        <li><a href="{{url('courses/create')}}">create</a></li>
        <li><a href="{{url('courses/1')}}">1</a></li>
    </ul>
                
@endsection
