@extends('layouts.app')

@section('title')
    Edit course
@endsection

@section('content')

<form action="/courses/{{$course->id}}" method="post" class="pure-form">
    {{ method_field('PUT') }}
    {{ csrf_field() }}
    {{--todo: expand task--}}
    Add or remove tasks from your course:


    {{-- got time? make checkboxes checked if task is already associated --}}
    @foreach ($tasks as $task)
        <div class="checkbox">
            <label>
                <input type="checkbox" name="tasks[]" value="{{$task->id}}" >{{$task->title}}
            </label>
        </div>
    @endforeach

    <fieldset class="pure-group">
        <input class="pure-input-1-2" type="text" name="title" id="title" placeholder="Title" value="{{$course->title}}">
        <textarea class="pure-input-1-2" name="body" id="body" cols="30" rows="10" placeholder="Description">{{$course->body}}</textarea>
    </fieldset>

    <button type="submit">Submit changes</button>
</form>

@endsection
