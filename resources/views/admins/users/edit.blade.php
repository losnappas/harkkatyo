@extends('layouts.app')

@section('title')
    Edit {{$user->name}} user role
@endsection

@section('content')

<form action="/admin/users/{{$user->id}}" method="post" class="pure-form">
    {!! method_field('PATCH') !!}
    {{ csrf_field() }}

    @foreach ($roles as $role)
    @if ($role->name == 'owner')
        @if ($user->hasRole($role->name))
            <div class="checkbox">
            <label>
                <input type="checkbox" {{$user->hasRole($role->name) ? 'checked' : ''}} name="roles[]" value="{{$role->id}}" disabled>{{$role->display_name}}
            </label>
        </div>
        @endif
        @continue
    @endif
        <div class="checkbox">
            <label>
                <input type="checkbox" {{$user->hasRole($role->name) ? 'checked' : ''}} name="roles[]" value="{{$role->id}}" >{{$role->display_name}}
            </label>
        </div>
    @endforeach
    <label for="name">Username</label>
    <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required>
    <label for="name">Email</label>
    <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>
    
    <button type="submit">Submit changes</button>
</form>

@endsection
