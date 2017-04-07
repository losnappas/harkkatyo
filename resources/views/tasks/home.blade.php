@extends('layouts.app')

@section('title')
    Tasks
@endsection

@section('content')
<ul>
    @foreach ($tasks as $task)
        <li><a href="/tasks/{{$task->id}}">{{$task->title}}</a>

        @can('update', $task)
        	<a href="/tasks/{{$task->id}}/edit">Edit</a>
        @endcan
        @can('delete', $task)
       			 <a href="/tasks/{{$task->id}}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();">
                                            Delete
                                        </a>
                <form id="delete-form" action="/tasks/{{$task->id}}" method="post" style="display: none;">
                    {{method_field('DELETE')}}
                    {{csrf_field()}}
                </form>
        @endcan
        </li>
    @endforeach
</ul>
    
    This is the 'tasks' page
    @can('create', \App\Task::class)
		<ul>
		    <li><a href="/tasks/create">create</a></li>
		</ul>
	@endcan
@endsection
