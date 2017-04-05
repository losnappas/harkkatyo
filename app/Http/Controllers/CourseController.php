<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests\StoreCourse;
use App\Course;
use App\Task;
use Auth;


class CourseController extends Controller
{
    public function forvue($id)   
    {
        return Course::find($id)->tasks()->get();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        return view('courses.home', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tasks = Task::all();
        return view('courses.create', compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\StoreCourse  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourse $request)
    {
        $request->persist();
        return redirect('/courses')->with('status', 'Course created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);
        $enrolled = $this->checkEnroll($id);

        return view('courses.course', compact('course', 'enrolled'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $tasks = Task::all();
        return view('courses.edit', compact('course', 'tasks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\StoreCourse  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCourse $request, $id)
    {
        $request->savechanges($id);
        return redirect('/courses');//->back();
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


    //enroll on a course
    public function enroll($id)
    {
        $course = Course::findOrFail($id);
        $enrolled = $this->checkEnroll($id);
        Auth::user()->courses()->toggle($course);
        if ($enrolled) 
            $status = 'Course unenrollment success';
        else
            $status = 'Course enrollment success';
        return redirect('/courses/'.$id)->with('status', $status);
    }

    public function start($id)
    {
        $course = Course::findOrFail($id);
        $task = $course->tasks()->first();
        return view('courses.do', compact('course', 'task'));
    }

    //where should this be placed in?
    //check if currently logged user has enrolled on $id course
    function checkEnroll($id)
    {
        foreach (Auth::user()->courses as $course) {
            if ($course != null && $course->id == $id) {
                return true;
            }
        }
        return false;
    }
}
