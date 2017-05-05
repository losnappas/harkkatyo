<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Session;
use App\Course;
use App\Task;
use App\Attempt;
use DB;


class TikoController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('tiko.home');
    }

    public function getAnswers($taskid)
    {
        $task = Task::findOrFail($taskid);
        
        //return Task::find($taskid)->answers()->get();
        return response(['dbAnswer' => $task->answers], 200);
    }

    public function checkAnswers(Request $request)
    {   //this is vulnerable code
        try{
            $answergiven = DB::select( DB::raw($request->body) );
        }catch(\Exception $e){
            $answergiven = $e->getMessage();
        }


        return response(['dbAnswer' => $answergiven], 200);
    }


    public function attemptStart(Request $request)
    {

        $attempt = new Attempt();
        $attempt->task()
            ->associate(Task::find($request->task));
        
        $attempt->session()
            ->associate(Session::find($request->session));
        $attempt->save();

        return $attempt->id;
    }


    public function attempt(Request $request)
    {
        try{
        $attempt = Attempt::find($request->attempt);

        $attempt->fill($request->except('attempt'));
        $attempt->end = \Carbon\Carbon::now();
        $attempt->save();
        }
        catch(\Exception $e){
            return response(['dbAnswer'=>$e->getMessage()],200);
        }
        // return response(['dbAnswer'=>$request->except('attempt')],200);
        //attempt ended: start a new attempt
        //return this->attemptStart($request);
    }

    public function done(Request $request)
    {
        try{
        $session = Session::findOrFail($request->session);
        $session->end = \Carbon\Carbon::now();
        $session->save();
        }
        catch(\Exception $e){
            return $e->getMessage();
        }
    }


    public function r1()
    {
        $sessions = Session::all();
        return view('reports.R1', compact('sessions'));
    }

    public function r2()
    {
        $r2 = DB::table('R2View')
                ->join('courses', 'courses.id', '=', 'R2View.course_id')
                ->get();

        return view('reports.R2', compact('r2'));
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
        $session = Session::findOrFail($id);

        //$session->course_id or $session->course()?
        //each session only has one course
        // $course = Course::findOrFail($session->course_id);
        $course = $session->courses;

        return view('courses.do', compact('course'));
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

        if ($request->has('roles')) {
            $this->authorize('changeRole', $user);
        }
        if ($request->has('roles')) {

        foreach ($request->roles as $role) {
            if ($role!=null && $role == 1) {
                return back()->with('status', 'Owner profile cannot be modified');
            }
        }
        }
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
        $user = User::findOrFail($id);
        $this->authorize('destroy', $user);
        User::destroy($user);
        return redirect('/admin/users')->with('status', 'User removed');
    }

}
