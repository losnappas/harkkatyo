@extends('layouts.app')

@include('layouts.partials.form')

@section('title')
    Task title: {{$task->title}}
@endsection

@section('content')

    {!! strip_tags($task->body, '<h1><b><strike><p>') !!}
    <br /><br />
    Answer: {{$task->answer}}
                
@endsection
