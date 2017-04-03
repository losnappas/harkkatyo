@extends('layouts.app')

@section('title')
    Task title: {{$task->title}}
@endsection

@section('content')
  <div id="task">

    <task-list
      courseid="{{$course->id}}">
    </task-list>

  <!--  <task-form courseid="{{$course->id}}"></task-form> -->
  </div>
;end;<!--
    {{$task->body}}
    <br /><br />
    <form action="/tasks/{{$task->id}}/answer" method="post" class="pure-form">
      {{ csrf_field() }}
        <label>
        Your answer<input class="pure-input-1-2" type="text" name="answer" id="answer" placeholder="Answer">
        </label>
        <button type="submit">Submit your answer</button>
    </form>
         -->       
@endsection
