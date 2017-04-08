@extends('layouts.app')

@include('layouts.partials.form')


@section('title')
    Edit task number {{$task->id}}
@endsection

@section('content')

<form action="{{route('tasks.update', ['id'=>$task->id])}}" method="post" class="pure-form">
    {{ method_field('PATCH') }}
    {{ csrf_field() }}
    <fieldset class="pure-group">
        <input class="pure-input-1-2" type="text" name="title" id="title" placeholder="Title" value="{{$task->title}}">
        <input class="pure-input-1-2" type="text" name="answer" id="answer" placeholder="Answer" value="{{$task->answer}}">
      
 		<custom-editor body="{{$task->body}}"></custom-editor>
    </fieldset>

    <button type="submit">Submit changes</button>
</form>
         
@endsection
