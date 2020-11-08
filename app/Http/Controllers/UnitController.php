<?php

namespace App\Http\Controllers;

use App\Unit;
use App\User;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{

    public function start($id)
    {
        //
        $unit = Unit::find($id);

        return view('units.start', compact('unit'));
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

		$unit = Unit::find($id);
		
        //$task = Task::find($id);
		//算分數
		foreach($data['answer'] as $task_id => $question){
			$task = Task::find($task_id);
		    foreach($question as $q_id => $score){
				$target_id = $task->content['target'][$q_id];
				$result[$target_id] = $result[$target_id] + $score;
				$person_score = $person_score + $score;
			}
		}
		//算滿分
		
		$tasks = $unit->tasks;
		
		foreach($tasks as $task){		
			$questions = $task->content['is_item'];
			foreach ($questions as $index => $is_item){
				if($is_item == 1){
					$target = $task->content['target'][$index];
					$total[$target] = $total[$target] + max($task->content['score'][$index]);
				}
			}
		}
        //算平均

        return view('units.result', compact('unit','targets','result','total','person_score'));
    }
	
    public function result()
    {
        //
        return view('units.result');
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

        $units = Unit::where(function ($query) use ($data) {
            if ($data) {
                foreach ($data as $k => $v) {
                    if ($v) {
                        $query->orWhere($k, 'like', '%' . $v . '%');
                    }
                }
            }
        })
            ->get();
			
			$targets = config('map.target');

        return view('units.view', compact('units','targets'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->except('_token');
        $data['user_id'] = Auth::user()->id;
        $model = new Unit;
        $model->fill($data);
        $model->save();

        return redirect('tasks/?unit_id=' . $model->id);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Unit $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Unit $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Unit $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Unit $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        //
        //$user = User::where('id', $id)->first();
        $unit->delete();
        return back();
    }
}
