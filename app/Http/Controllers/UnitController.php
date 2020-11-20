<?php

namespace App\Http\Controllers;

use App\Http\Traits\MyTraits;
use App\Unit;
use App\UserUnit;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    use MyTraits;

    public function copy($id)
    {
        $unit = Unit::find($id)->replicate();
        $unit->name = $unit->name . "(複製)";
        $unit->is_open = 0;
        $unit->status = 0;
        $unit->save();

        $tasks = Task::where('unit_id', $unit->id)->get();
        foreach ($tasks as $task) {
            $task = Task::find($task->id)->replicate();
            $task->unit_id = $unit->id;
            $task->save();
        }

        return "OK";
        return back();
    }

    public function start($id)
    {
        //
        $unit = Unit::find($id);

        return view('units.start', compact('unit'));
    }

    public function postStart(Request $request, $id)
    {
        //
        $data = $request->all();
        $user = Auth::user();
        if ($user->role == 3) {
            $user_unit = new UserUnit;
            $user_unit->fill([
                'user_id' => $user->id,
                'unit_id' => $id,
                'score' => $data['answer']
            ]);
            $user_unit->save();
        }

        //dd($data);
        $result = $this->getTargetInitial();
        $total = $this->getTargetInitial();
        $avg = $this->getTargetInitial();
        $count = $this->getTargetInitial();
        $person_score = 0;
        $avg_score = 0;
        $targets = config('map.target');

        $unit = Unit::find($id);

        //算題數
        /*
        $tasks = $unit->tasks;
        foreach ($tasks as $task) {
            $count_list = array_count_values($task->content['target']);
            foreach ($count_list as $k => $v) {
                $count[$k] = $count[$k] + $v;
            }
        }
        */

        $tasks = $unit->tasks;
        foreach ($tasks as $task) {
            $is_item_array = $task->content['is_item'];
            foreach ($is_item_array as $index => $is_item) {
                if ($is_item == 1) {
                    $target = $task->content['target'][$index];
                    $count[$target] = $count[$target] + 1;
                }
            }
        }

        //$task = Task::find($id);
        //算個人分數
        $result = $this->calScore($data['answer'], $count);
        /*
        foreach ($data['answer'] as $task_id => $question) {
            $task = Task::find($task_id);
            foreach ($question as $q_id => $score) {
                $target_id = $task->content['target'][$q_id];
                $result[$target_id] = $result[$target_id] + $score;
            }
        }
        */

        foreach ($result as $k => $v) {
            if ($count[$k] != 0) {
                $person_score = $person_score + $result[$k];
            }
        }


        //算滿分

        $tasks = $unit->tasks;

        foreach ($tasks as $task) {
            $questions = $task->content['is_item'];
            foreach ($questions as $index => $is_item) {
                if ($is_item == 1) {
                    $target = $task->content['target'][$index];
                    $total[$target] = $total[$target] + max($task->content['score'][$index]);
                }
            }
        }

        foreach ($total as $k => $v) {
            if ($count[$k] != 0) {
                $total[$k] = round($v / $count[$k], 1);
            }
        }

        //算平均
        $students = $this->getStudentNow();

        $user_scores = UserUnit::where('unit_id', $id)
            ->whereIn('user_id', $students->pluck('id')->toArray())
            ->get();
        if ($user_scores->count() > 0) {
            foreach ($user_scores as $user_score) {
                $avg = $this->calScore($user_score->score, $count);
            }

            foreach ($avg as $k => $v) {
                if ($count[$k] != 0) {
                    $avg[$k] = round($v / $students->count(), 1);
                    $avg_score = $avg_score + $avg[$k];
                }
            }
        }


        return view('units.result', compact('unit', 'targets', 'result', 'total', 'avg', 'person_score', 'avg_score'));
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

        $user = Auth::user();

        return view('units.view', compact('user', 'units', 'targets'));
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
