@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading">Create a task</div>
                
                <div class="panel-body">
                    <form action="/tasks" method="post" class="pure-form">
                        {{ csrf_field() }}
                        <fieldset class="pure-group">
                            <input class="pure-input-1-2" type="text" name="title" id="title" placeholder="Title">
                            <input class="pure-input-1-2" type="text" name="answer" id="answer" placeholder="Answer">
                            <textarea class="pure-input-1-2" name="body" id="body" cols="30" rows="10" placeholder="Description" ></textarea>
                        </fieldset>

                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
