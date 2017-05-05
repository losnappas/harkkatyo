@extends('layouts.app')

@section('title')
    Report #1: 	Information about individual sessions
@endsection

@section('content')
	<table>
		<tr>
			<th>User</th>
			<th>Correct answers</th>
		</tr>
		@foreach ($sessions as $session)
			<tr>
				<td>{{\App\User::find($session->user_id)->name}}</td>
				<td>{{$session->completed}}</td>
			</tr>
		@endforeach
	</table>
@endsection
<style>
	table, th, td{
		border: 1px solid black;
	}
	table{
		width: 100%;
	}
	th{
		height: 50px;
	}
</style>