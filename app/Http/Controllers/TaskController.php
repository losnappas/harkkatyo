<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCourse;
use App\Task;
use App\Answer;
use Auth;
// use App\Http\Requests;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', Task::class);
        $tasks = Task::all();
        return view('tasks.home', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Task::class);
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCourse  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request/*StoreCourse $request*/)
    {
        $task = new Task([
            'body' => $request->body,
            'title' => $request->title,
        ]);
        $task->creator()->associate(Auth::user());
        $task->save();

        $answer = new Answer([
            'body' => $request->answer,
        ]);

        $answer->task()->associate($task);
        $answer->save();

        return back()->with('status', 'Task created');

        // www version
        /*$this->authorize('create', Task::class);
        $request->persist();
        return back()->with('status', 'Task created');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        $this->authorize('view', $task);
        $answers = $task->answers;
        return view('tasks.task', compact('task', 'answers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $this->authorize('update', $task);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreCourse  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCourse $request, $id)
    {
        $task = Task::findOrFail($id);
        
        $answer = new Answer([
            'body' => $request->answer,
        ]);

        $answer->task()->associate($task);
        $answer->save();

        $this->authorize('update', $task);
        $request->savechanges($id);
        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $this->authorize('delete', $task);
        $task->delete();
        return redirect('/tasks')->with('status', 'Task deleted');
    }
}
