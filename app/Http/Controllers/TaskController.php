<?php

namespace App\Http\Controllers;

use App\Task;
use App\Unit;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data = $request->all();
        $unit_id = $data['unit_id'];
        $tasks = Task::where("unit_id", $unit_id)->get();
        return view('tasks.view', compact('unit_id', 'tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $data = $request->all();
        $task_id = $data['task_id'];
        $task = Task::find($task_id);

        $targets = config('map.target');
        $scoreNum = 5;
        return view('tasks.create', compact('targets', 'scoreNum', 'task'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Integer $unit_id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->except('_token');
        $content = $data['content'];
        $data['content'] = [];
        $data['content']['count'] = explode(',', $content);
        $model = new Task;
        $model->fill($data);
        $model->save();


        /*
        foreach ($data as $index => $unit) {
            $unit['order'] = $index;
            $model = new Unit();
            $model->fill($unit);
            $model->save();
        }
        */

        return redirect('tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
        $task->delete();
        return back();
    }
}
