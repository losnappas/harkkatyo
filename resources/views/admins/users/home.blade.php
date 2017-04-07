@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    Welcome to the users page.
    <ul>
    @foreach ($users as $user)
    	@can('view', $user)
			<li><a href="/admin/users/{{$user->id}}">{{$user->name}}</a></li>
		@endcan
	@endforeach
	</ul>
@endsection