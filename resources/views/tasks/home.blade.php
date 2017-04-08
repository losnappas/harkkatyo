@extends('layouts.app')

@section('title')
    Tasks
@endsection

@section('content')
<ul>
    @foreach ($tasks as $task)
        <li><a href="{{url('/tasks/'.$task->id)}}">{{$task->title}}</a>

        @can('update', $task)
        	<a href="{{url('/tasks/'.$task->id.'/edit')}}">Edit</a>
        @endcan
        @can('delete', $task)
       			 <a href="{{url('/tasks/'.$task->id)}}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('delete-form{{$task->id}}').submit();">
                                            Delete
                                        </a>
                <form id="delete-form{{$task->id}}" action="{{route('tasks.destroy', ['id'=>$task->id])}}" method="post" style="display: none;">
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
		    <li><a href="{{url('/tasks/create')}}">create</a></li>
		</ul>
	@endcan
@endsection
