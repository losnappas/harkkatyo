@extends('layouts.app')

@section('title')
    Create course
@endsection

@section('content')

<form action="/courses" method="post" class="pure-form">
    {{ csrf_field() }}
    {{--todo: expand task--}}
    Add tasks for your course:
    @foreach ($tasks as $task)
        <div class="checkbox">
            <label>
                <input type="checkbox" name="tasks[]" value="{{$task->id}}"> {{$task->title}}
            </label>
        </div>
    @endforeach

    <fieldset class="pure-group">
        <input class="pure-input-1-2" type="text" name="title" id="title" placeholder="Title">
        <textarea class="pure-input-1-2" name="body" id="body" cols="30" rows="10" placeholder="Description" ></textarea>
    </fieldset>

    <button type="submit">Add Course</button>
</form>

@endsection
