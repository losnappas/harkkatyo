@extends('layouts.app')


@section('title')
    Courses
@endsection

@section('content')

    <ul>
        @foreach ($courses as $course)
            <li><a href="/courses/{{$course->id}}">{{$course->title}}</a>
            @can('update', $course)
                <a href="/courses/{{$course->id}}/edit">Edit</a>
            @endcan
            @can('delete', $course)
                <a href="/courses/{{$course->id}}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();">
                                            Delete
                                        </a>
                <form id="delete-form" action="/courses/{{$course->id}}" method="post" style="display: none;">
                    {{method_field('DELETE')}}
                    {{csrf_field()}}
                </form>
            @endcan
            </li>
        @endforeach
    </ul>
    
    This is the 'courses' page
    @can('create', \App\Course::class)
    <ul>
        <li><a href="{{url('courses/create')}}">create</a></li>
    </ul>
    @endcan
@endsection
