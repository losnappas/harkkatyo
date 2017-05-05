
	<!-- {{--great spot for some JS? to be seen.. nah toggle 'has it'--}}
	@if(Auth::check())
		
		<form action="{{route('courses.enroll', ['id'=>$course->id])}}" method="post" class="pure-form">
			{{ csrf_field() }}
			<button type="submit">
			@if ($enrolled)
				Unenroll
			@else
				Enroll this course
			@endif
			</button>
		</form>
	@endif -->