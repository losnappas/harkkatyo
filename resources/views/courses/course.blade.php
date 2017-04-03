@extends('layouts.app')

@section('title')
    Course title: {{$course->title}}
@endsection

@section('content')

    {{$course->body}}
    <br /><br />
    Tasks:
    <ul>
        @forelse($course->tasks as $task)
            <li>{{$task->title}}</li>
        @empty
        	<p>No tasks</p>
        @endforelse
    </ul>

	{{--great spot for some JS? to be seen.. nah toggle 'has it'--}}
	@if(Auth::check())
		
		<form action="/courses/{{$course->id}}/enroll" method="post" class="pure-form">
			{{ csrf_field() }}
			<button type="submit">Un/enroll this course</button>
		</form>
	@endif
	<br />
	<form action="/courses/{{$course->id}}/start" method="post" class="pure-form">
		{{ csrf_field() }}
		<button type="submit">Start the course</button>
	</form>
@endsection
