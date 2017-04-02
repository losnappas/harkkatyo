@extends('layouts.app')

@section('title')
    Unauthorized action
@endsection

@section('content')

<div class="centering text-center error-container">
    <div class="text-center">
        <h2 class="without-margin"><span class="text-danger"><big>403 Access Denied</big></span></h2>
        <h4 class="text-danger">You do not have permission to access this page.</h4>
    </div>
    <div class="text-center">
        <h3><small>Choose an option below</small></h3>
    </div>
    <hr>
    <ul class="pager">
        <li><a href="{{URL::previous()}}">← Go Back</a></li>
        <li><a href="/">Home Page</a></li>
    </ul>
</div>

@endsection