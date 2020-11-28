<?php

namespace App\Http\Controllers;

use App\Http\Traits\MyTraits;
use App\Task;
use App\Unit;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class TaskController extends Controller
{
    use MyTraits;

    public function copy($id)
    {
        $task = Task::find($id)->replicate();
        $task->order = Task::where('unit_id', $task->unit_id)->max('order') + 1;
        $task->name = $task->name . "(複製)";
        $task->save();

        return "OK";
        return back();
    }

    public function start($id)
    {
        //
        $task = Task::find($id);

        return view('tasks.start', compact('task'));
    }

    public function postStart(Request $request, $id)
    {
        //
        $data = $request->all();
        if (!array_key_exists('answer', $data)) {
            return "無作答紀錄";
        }
        //dd($data);
        $result = $this->getTargetInitial();
        $total = $this->getTargetInitial();
        $count = $this->getTargetInitial();
        $person_score = 0;
        $targets = config('map.target');

        $task = Task::find($id);

        //算題數
        $count_list = array_count_values($task->content['target']);
        foreach ($count_list as $k => $v) {
            $count[$k] = $v;
        }
		//dd($count_list);
        /*
        $is_item_array = $task->content['is_item'];
        foreach ($is_item_array as $index => $is_item) {
            if ($is_item == 1) {
                $target = $task->content['target'][$index];
                $count[$target] = $count[$target] + 1;
            }
        }
        */

        //算分數
        //dd($data['answer']);
        foreach ($data['answer'] as $task_id => $question) {
            foreach ($question as $index => $score_array) {
                $target_id = $task->content['target'][$index];
                $result[$target_id] = $result[$target_id] + array_sum($score_array);;
            }
        }
		
        /*
        $q_id = 0;
        foreach($task->content['count'] as $index => $q_count){
            for( $sub = 0; $sub < $q_count; $sub++){
                if($task->content['is_item'][$q_id] == 1){
                    $target = $task->content['target'][$index];
                    $max_temp = max($task->content['score'][$q_id]);
                    if($max_temp > $total[$target]){
                        $total[$target] = $max_temp;
                    }
                }
            $q_id++;
            }
        }
        */

        foreach ($result as $k => $v) {
            if ($count[$k] != 0) {
                $result[$k] = round($v / $count[$k], 1);
                $person_score = $person_score + $result[$k];
            }
        }

        //算滿分
        $q_id = 0;
        foreach ($task->content['count'] as $index => $q_count) {
            $target = $task->content['target'][$index];
			$max_temp = 0;
            for ($sub = 0; $sub < $q_count; $sub++) {
                if ($task->content['is_item'][$q_id] == 1) {
                    if ((int) max($task->content['score'][$q_id]) > (int) $max_temp) {
                        $max_temp = max($task->content['score'][$q_id]);
                    }
                }
                $q_id++;
            }
            $total[$target] = $total[$target] + $max_temp;
        }
        /*
        $questions = $task->content['is_item'];
        foreach ($questions as $index => $is_item) {
            if ($is_item == 1) {
                $target = $task->content['target'][$index];
                $total[$target] = $total[$target] + max($task->content['score'][$index]);
            }
        }
        */
        foreach ($total as $k => $v) {
            if ($count[$k] != 0) {
                $total[$k] = round($v / $count[$k], 1);
            }
        }

        //算平均

        return view('tasks.result', compact('task', 'targets', 'result', 'total', 'person_score', 'count'));
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
        $tasks = Task::ordered()
            ->where("unit_id", $unit_id)
            ->get();
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

        if (array_key_exists('update_order', $data)) {
            foreach ($data['update_order'] as $index => $template_id) {
                Task::find($template_id)->update(['order' => $index + 1]);
            }
            return back();
        } else {
            $content = $data['content'];
            $data['content'] = [];
            $data['content']['count'] = explode(',', $content);
            $model = new Task;
            $model->fill($data);
            $model->save();
        }
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
