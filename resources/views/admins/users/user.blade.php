@extends('layouts.app')

@section('title')
    User {{$user->name}}
@endsection

@section('content')
    Only an admin can visit this page. <br />
	Courses the user is enlisted on: <br />
	soontm
	<tr>
		@foreach($roles as $role)
			<td><input type="checkbox" {{ $user->hasRole('owner') ? 'checked' : '' }} name="{{$role}}"></td>
		@endforeach
	</tr>
@endsection