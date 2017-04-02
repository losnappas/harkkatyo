@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    Only an owner could visit this page.
    <ul>
    @foreach ($users as $user)
    	@can('view', $user)
			<li><a href="/admin/users/{{$user->id}}">{{$user->name}}</a></li>
		@endcan
	@endforeach
	</ul>
@endsection