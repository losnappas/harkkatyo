@extends('layouts.app')

@section('title')
    User: {{$user->name}}
@endsection

@section('content')
    Only an admin can visit this page. <br />
	Courses the user is enlisted on: <br />
	soontm
	<tr>
		@foreach($roles as $role)

				<td><input type="checkbox" {{ $user->hasRole($role) ? 'checked' : '' }} name="{{$role}}"></td>
			
		@endforeach
	</tr>
	<a href="/admin/users/{{$user->id}}/edit">Edit this guy</a>
@endsection