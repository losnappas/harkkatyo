<!-- Blog Sidebar Widgets Column -->
<div class="col-md-2" style="width: 13%; display: inline-block; overflow: hidden;">

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Linkerinos</h4>
        <ul>
	        @role('admin')
	            <li><a href="/admin/users">Manage users</a></li>
	        @endrole
	        @role('owner')
	        	<li><a href="/admin/owner">Manage owner things</a></li>
	        @endrole
	            
	        <li><a href="/courses">Courses</a></li>
	        <li><a href="/tasks">Tasks</a></li>
        </ul>
    </div>

</div>