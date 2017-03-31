@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    Only an owner can visit this page.
    <ul>
    @foreach ($users as $user)
		<li><a href="/admin/users/{{$user->id}}">{{$user->name}}</a></li>
	@endforeach
	</ul>
@endsection