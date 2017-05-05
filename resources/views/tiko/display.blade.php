@extends('layouts.app')


@section('title')
    Sessions
@endsection

@section('content')
	@foreach($courses as $course)
		<a href="{{url('/courses/'.$course->id)}}">Course {{$course->id}}</a>
	@endforeach
@endsection