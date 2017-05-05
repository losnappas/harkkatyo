@extends('layouts.app')

@section('title')
    Course title: {{$course->title}}
@endsection

@section('content')

    {!! strip_tags($course->body, '<h1><b><strike><p>') !!}
    <br /><br />
    Tasks:
    <ul>
        @forelse($course->tasks as $task)
            <li>{{$task->title}}</li>
        @empty
        	<p>No tasks</p>
        @endforelse
    </ul>

	<br />
	<form action="{{route('courses.start', ['id' => $course->id])}}" method="post" class="pure-form">
		{{ csrf_field() }}
		<button type="submit">Start the course</button>
	</form>
@endsection
