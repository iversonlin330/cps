<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class TaskController extends Controller
{
    public function start($id)
    {
        //
        $task = Task::find($id);

        return view('tasks.start', compact('task'));
    }

	public function postStart(Request $request,$id)
    {
        //
		$data = $request->all();
		//dd($data);
		$result = [];
        $total = [];
		$person_score = 0;
		$targets = config('map.target');
		foreach($targets as $target_id => $value){
			$result[$target_id] = 0;
            $total[$target_id] = 0;
		}

        $task = Task::find($id);
		//算分數
		foreach($data['answer'] as $task_id => $question){
		    foreach($question as $q_id => $score){
				$target_id = $task->content['target'][$q_id];
				$result[$target_id] = $result[$target_id] + $score;
				$person_score = $person_score + $score;
			}
		}
		//算滿分
        $questions = $task->content['is_item'];
		foreach ($questions as $index => $is_item){
		    if($is_item == 1){
		        $target = $task->content['target'][$index];
		        $total[$target] = $total[$target] + max($task->content['score'][$index]);
            }
        }
        //算平均


        return view('units.result', compact('task','targets','result','total','person_score'));
    }

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

        $map = [];
        $q_id = 0;
        foreach ($task->content['count'] as $index => $q_count) {
            for ($sub = 0; $sub < $q_count; $sub++) {
                $map[$index][$sub] = $q_id;
                $q_id++;
            }
        }

        return view('tasks.create', compact('targets', 'scoreNum', 'task', 'map'));
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
         * update order
        if(isset($data['order'])){
        foreach ($data as $index => $unit) {
            $unit['order'] = $index;
            $model = Task()::find($taks_id);
            $model->fill($unit);
            $model->save();
        }
        }
        */

        return redirect('tasks/create?task_id=' . $model->id);
    }

    public function updateStr(Request $request, $id)
    {
        //
        $data = $request->except('_token');
        $content = $data['content'];

        $result = [];
        $result['name'] = $data['name'];

        $model = Task::find($id);
        $result['content'] = $model['content'];
        $result['content']['count'] = explode(',', $content);
        $model->fill($result);
        $model->save();

        return redirect('tasks/create?task_id=' . $model->id);
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
        $data = $request->except(['_token', '_method']);
        $count = explode(',', $data['count']);;
        $data['count'] = $count;

        $result = [];
        $result['content'] = $data;

        //$model = new Task;
        $task->fill($result);
        $task->save();

        return redirect('tasks?unit_id=' . $task->unit_id);
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
