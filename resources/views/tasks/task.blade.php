@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Task title: {{$task->title}}</div>
                <div class="panel-body">
                    Body: {{$task->body}}
                    <br /><br />
                    Answer: {{$task->answer}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
