@extends('layouts.app')

@section('title')
	My courses
@endsection

@section('content')
	<ul>
		@forelse($user->courses as $course)
			<li><a href="{{url('/courses/'.$course->id)}}">{{$course->title}}</a></li>
		@empty
			<p>Not yet enrolled on any courses</p>
		@endforelse
	</ul>
@endsection