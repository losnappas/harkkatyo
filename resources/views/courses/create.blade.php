@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading">Create course</div>
                
                <div class="panel-body">
                    <form action="/courses/store" method="post" class="pure-form">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
