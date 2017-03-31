@extends('layouts.app')

@section('title')
    Create a task
@endsection

@section('content')

<form action="/tasks" method="post" class="pure-form">
    {{ csrf_field() }}
    <fieldset class="pure-group">
        <input class="pure-input-1-2" type="text" name="title" id="title" placeholder="Title">
        <input class="pure-input-1-2" type="text" name="answer" id="answer" placeholder="Answer">
        <textarea class="pure-input-1-2" name="body" id="body" cols="30" rows="10" placeholder="Description" ></textarea>
    </fieldset>

    <button type="submit">Submit</button>
</form>

@endsection
