@extends('layouts.app')

@include('layouts.partials.form')

@section('title')
    Create course
@endsection


@section('content')

<form action="{{route('courses.create')}}" method="post" class="pure-form">
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
    <input type="hidden" name="teacher_id" id="teacher_id" value="{{Auth::user()->id}}">
    <fieldset class="pure-group">
        <input class="pure-input-1-2" type="text" name="title" id="title" placeholder="Title">
        <custom-editor></custom-editor>
    </fieldset>
    <button type="submit">Add Course</button>

</form>

@endsection
