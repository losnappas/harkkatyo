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
use Auth;


class TikoController extends Controller
{
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

        $session->completed = Attempt::where('session_id', $session->id)->max('count');
        
        $session->save();
        }
        catch(\Exception $e){
            return $e->getMessage();
        }
    }


    public function r1()
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole(['owner', 'teacher'])) {
                $sessions = Session::all();
            }else {
                $sessions = Session::where('user_id', Auth::user()->id)->get();
            }
            return view('reports.R1', compact('sessions'));
        }
        else{
            return redirect('/courses');
        }
    }

    public function r2()
    {
        $r2 = DB::table('r2view')
                ->join('courses', 'courses.id', '=', 'r2view.course_id')
                ->get();

        return view('reports.R2', compact('r2'));
    }

    public function display()
    {
        $opiskelijat = DB::table('opiskelijat')->get();
        $kurssit = DB::table('kurssit')->get();
        $suoritukset = DB::table('suoritukset')->get();

        return response(['opiskelijat'=>$opiskelijat,
                    'kurssit'=>$kurssit,
                    'suoritukset'=>$suoritukset
                ], 200);
    }
}
