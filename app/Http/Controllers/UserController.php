<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use Illuminate\Foundation\Auth\User;
use App\Http\Requests\StoreCourse;
use App\User;
use App\Role;
use App\Course;


class UserController extends Controller
{
    public function __construct()
    {
        return true;//$this->middleware('role:owner');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admins.users.home', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('view', $user);

        $roles = Role::all();
        return view('admins.users.user', compact('user', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admins.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCourse $request, $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user);
        $request->savechanges($id);
        return redirect('/admin/users')->with('status', 'User updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    //show list of courses enrolled by the user
    public function enrolls($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('view', $user);
        $courses = Course::all();
        return view('admins.users.enrolls', compact('courses', 'user'));
    }
}
