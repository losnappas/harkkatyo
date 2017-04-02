@extends('layouts.app')

@section('title')
    User: {{$user->name}}
@endsection

@section('content')
    Only an admin can visit this page. <br />
	Courses the user is enlisted on: <br />
	soontm<br />

	<table>
	<thead>
		@foreach($roles as $role)
			<th>{{$role->name}}</th>
		@endforeach
	</thead>
	<br />
	<tbody>
	<tr>
		@foreach($roles as $role)

		<td style="width: 80px;"><input type="checkbox" {{ $user->hasRole($role->name) ? 'checked' : '' }} name="{{$role->name}}" disabled></td>
			
		@endforeach
	</tr>
	</tbody>
	</table>
	<a href="/admin/users/{{$user->id}}/edit">Edit this guy</a>
@endsection