<!-- Blog Sidebar Widgets Column -->
<div class="col-md-2" style="width: 13%; display: inline-block; overflow: hidden;">

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Linkerinos</h4>
        <ul>
            <li><a href="{{url('/admin/users')}}">Manage users</a></li>
	        <li><a href="{{url('/courses')}}">Courses</a></li>
	        <li><a href="{{url('/tasks')}}">Tasks</a></li>
            <!-- feature removed.. too lazy
             @if(Auth::check())
                <li><a href="{{ url('/admin/users/'.Auth::user()->id.'/enrolls') }}">My courses</a></li>
            @endif -->
            <li><a href="{{url('/tiko/reports/r1')}}">R1 reports</a></li>
            <li><a href="{{url('/tiko/reports/r2')}}">R2 reports</a></li>
        </ul>
    </div>

</div>