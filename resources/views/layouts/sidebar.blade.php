<!-- Blog Sidebar Widgets Column -->
<div class="col-md-2" style="width: 13%; display: inline-block; overflow: hidden;">

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Linkerinos</h4>
        <ul>
            <li><a href="/admin/users">Manage users</a></li>
	        <li><a href="/courses">Courses</a></li>
	        <li><a href="/tasks">Tasks</a></li>
            @if(Auth::check())
                <li><a href="/admin/users/{{Auth::user()->id}}/enrolls">My courses</a></li>
            @endif
        </ul>
    </div>

</div>