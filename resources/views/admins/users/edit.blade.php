@extends('layouts.app')

@section('title')
    Edit user role
@endsection

@section('content')

<form action="/users/{{$user}}" method="post" class="pure-form">
    {{ method_field('PUT') }}
    {{ csrf_field() }}
    {{--todo: expand task--}}
    


    {{-- got time? make checkboxes checked if task is already associated --}}
    @foreach ($roles as $role)
        <div class="checkbox">
            <label>
                <input type="checkbox" name="roles[]" value="{{$role->id}}" >{{$role->display_name}}
            </label>
        </div>
    @endforeach
    <button type="submit">Submit changes</button>
</form>

@endsection
