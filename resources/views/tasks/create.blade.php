@extends('layouts.app')

@include('layouts.partials.form')

@section('title')
    Create a task
@endsection

@section('content')

<form action="{{route('tasks.store')}}" method="post" class="pure-form">
    {{ csrf_field() }}
    <fieldset class="pure-group">
        <input class="pure-input-1-2" type="text" name="title" id="title" placeholder="Title">
        <input class="pure-input-1-2" type="text" name="answer" id="answer" placeholder="Answer">
        <custom-editor></custom-editor>
    </fieldset>

    <button type="submit">Submit</button>
</form>

@endsection
