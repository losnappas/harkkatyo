@extends('layouts.app')

@section('title')
    Edit task number {{$task->id}}
@endsection

@section('content')

<form action="/tasks/{{$task->id}}" method="post" class="pure-form">
    {{ method_field('PUT') }}
    {{ csrf_field() }}
    <fieldset class="pure-group">
        <input class="pure-input-1-2" type="text" name="title" id="title" placeholder="Title" value="{{$task->title}}">
        <input class="pure-input-1-2" type="text" name="answer" id="answer" placeholder="Answer" value="{{$task->answer}}">
        <textarea class="pure-input-1-2" name="body" id="body" cols="30" rows="10" placeholder="Description">{{$task->body}}</textarea>
    </fieldset>

    <button type="submit">Submit changes</button>
</form>
         
@endsection
