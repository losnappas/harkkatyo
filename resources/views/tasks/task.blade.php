@extends('layouts.app')

@section('title')
    Task title: {{$task->title}}
@endsection

@section('content')

    Body: {{$task->body}}
    <br /><br />
    Answer: {{$task->answer}}
                
@endsection
