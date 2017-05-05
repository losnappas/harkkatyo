@extends('layouts.app')


@section('title')
    Tiko login
@endsection

@section('content')
	@unless (Auth::check())
		<form action="{{route('tiko.login')}}" method="post">
			{{csrf_field()}}
			<input type="text" name="name" id="name" placeholder="Name">
			<input type="text" name="subject" id="subject" placeholder="Subject">
			<input type="text" name="student_num" id="student_num" placeholder="Student number">
			<button type="submit">Login</button>
		</form>
	@else
		logged in (change this to 'what if: teacher' thing)
	@endunless
@endsection