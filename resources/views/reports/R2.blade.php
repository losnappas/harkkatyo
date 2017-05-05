@extends('layouts.app')

@section('title')
    Report #2: Course-session stats synopsis
@endsection

@section('content')
	<table>
		<tr>
			<th>Course name</th>
			<th>Average time</th>
			<th>Fastest time</th>
			<th>Slowest time</th>
		</tr>
		@foreach ($r2 as $row)
			<tr>
				<td>
					{{$row->title}}
				</td>
				<td>
					{{gmdate("H:i:s",$row->average)}}
				</td>
				<td>
					{{gmdate("H:i:s",$row->fastest)}}
				</td>
				<td>
					{{gmdate("H:i:s",$row->slowest)}}
				</td>

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