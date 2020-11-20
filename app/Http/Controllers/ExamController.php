<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Http\Traits\MyTraits;
use App\Unit;
use App\UserUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    use MyTraits;

    public function order()
    {
        //
        return redirect('exams');
    }

    public function start($id)
    {
        $exam = Exam::find($id);
        return view('exams.start', compact('exam'));
    }

    public function postStart(Request $request, $id)
    {
        //
        $data = $request->all();
        $user = Auth::user();
        if ($user->role == 3) {
            $user_exam = new UserExam;
            $user_exam->fill([
                'user_id' => $user->id,
                'exam_id' => $id,
                'score' => $data['answer']
            ]);
            $user_exam->save();
        }

        //dd($data);
        $result = $this->getTargetInitial();
        $total = $this->getTargetInitial();
        $avg = $this->getTargetInitial();
        $count = $this->getTargetInitial();
        $person_score = 0;
        $avg_score = 0;
        $targets = config('map.target');

        $exam = Exam::find($id);
        $units = $exam->units();
        foreach ($units as $unit) {
            $tasks = $unit->tasks;
            foreach ($tasks as $task) {
                $is_item_array = $task->content['is_item'];
                foreach ($is_item_array as $index => $is_item) {
                    if ($is_item == 1) {
                        $target = $task->content['target'][$index];
                        $count[$target] = $count[$target] +1;
                    }
                }
            }
        }
        $unit = Unit::find($id);


        $tasks = $unit->tasks;
        foreach ($tasks as $task) {
            $count_list = array_count_values($task->content['target']);
            foreach ($count_list as $k => $v) {
                $count[$k] = $count[$k] + $v;
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
        $id = 1;
        $exam = Exam::find($id);
        $exam->units;
        foreach ($exam->units as $unit) {
            dd($unit->tasks);
        }
        dd($exam->units);
        return view('exams.result');
    }

    public function score()
    {
        //
        $targets = config('map.target');
        return view('exams.score', compact('targets'));
    }

    public function scoreDetail()
    {
        //
        $targets = config('map.target');
        return view('exams.score-detail', compact('targets'));
    }

    public function my()
    {
        //
        return view('exams.my');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $targets = config('map.target');

        $exams = Exam::all();

        return view('exams.view', compact('exams', 'targets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = Auth::user();
        $myUnits = Unit::where('user_id', $user->id)->get();

        $openUnits = Unit::where('is_open', 1)->get();

        return view('exams.create', compact('myUnits', 'openUnits'));
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

        $user = Auth::user();

        $model = new Exam;
        $model->fill([
            'name' => $data['name'],
            'user_id' => $user->id
        ]);
        $model->save();

        //$model->units()->attach($data['unit_id']);

        return view('exams.create-order');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        //
    }
}
