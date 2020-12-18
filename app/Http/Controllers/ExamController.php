<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\ClassroomExam;
use App\Cycle;
use App\Exam;
use App\Exports\ScoreExport;
use App\Http\Traits\MyTraits;
use App\Unit;
use App\User;
use App\UserExam;
use App\UserUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Psy\CodeCleaner\AssignThisVariablePass;

class ExamController extends Controller
{
    use MyTraits;

    public function postAssign(Request $request, $exam_id)
    {
        //
        $data = $request->except('_token');
        $user = Auth::user();

        if (!array_key_exists('classroom_id', $data)) {
            $data['classroom_id'] = [];
        }

        $classroom_id_array = Classroom::now()->get()->pluck('id')->toArray();
        ClassroomExam::where('exam_id', $exam_id)->whereIn('classroom_id', $classroom_id_array)->delete();
        foreach ($data['classroom_id'] as $classroom_id) {
            $model = new ClassroomExam;
            $model->fill([
                'classroom_id' => $classroom_id,
                'exam_id' => $exam_id,
                'user_id' => $user->id
            ]);
            $model->save();
        }

        return back();
    }

    public function order()
    {
        //
        return redirect('exams');
    }

    public function start($id)
    {
        $exam = Exam::find($id);

        $task_length = 0;

        foreach ($exam->units() as $unit) {
            $task_length = $task_length + count($unit->tasks);
        }

        return view('exams.start', compact('exam', 'task_length'));
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
                $count_list = array_count_values($task->content['target']);
                foreach ($count_list as $k => $v) {
                    $count[$k] = $count[$k] + $v;
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

        foreach ($units as $unit) {
            $tasks = $unit->tasks;
            foreach ($tasks as $task) {
                $q_id = 0;
                foreach ($task->content['count'] as $index => $q_count) {
                    $target = $task->content['target'][$index];
                    $max_temp = 0;
                    for ($sub = 0; $sub < $q_count; $sub++) {
                        if ($task->content['is_item'][$q_id] == 1) {
                            //$max_temp = max($task->content['score'][$q_id]);
                            if (max($task->content['score'][$q_id]) > $max_temp) {
                                $max_temp = max($task->content['score'][$q_id]);
                            }
                        }
                        $q_id++;
                    }
                    $total[$target] = $total[$target] + $max_temp;
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

        $user_scores = UserExam::where('exam_id', $id)
            ->whereIn('user_id', $students->pluck('id')->toArray())
            ->get();
        if ($user_scores->count() > 0) {
            foreach ($user_scores as $user_score) {
                $avg = $this->calScore($user_score->score, $count);
            }

            foreach ($avg as $k => $v) {
                if ($count[$k] != 0) {
                    $avg[$k] = round($v / $user_scores->count(), 1);
                    $avg_score = $avg_score + $avg[$k];
                }
            }
        }

        $avg = $exam->avg_score();
        $avg_score = array_sum($avg);


        return view('exams.result', compact('exam', 'targets', 'result', 'total', 'avg', 'person_score', 'avg_score'));
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

    public function score(Request $request)
    {
        //
        $data = $request->all();
        $user = Auth::user();
        $targets = config('map.target');

        //$exam_id_array = UserExam::where('user_id', $user->id)->get()->pluck('exam_id')->toArray();

        //$exams = $user->classroom->exams->whereIn('id', $exam_id_array)->all();

        $classroom = [];
        if ($user->role == 9) {
            $exams = Exam::all();
        } else {
            $exams = Exam::where('user_id', $user->id)->get();
            $classroom = $user->tutor_classroom();
        }

        if (!$data) {
            $data['cycle_id'] = Cycle::latest()->first()->id;
        }

        unset($data['city_id']);

        $citys = $this->getSchool();

        $cycles = Cycle::orderBy('id', 'desc')->get();

        return view('exams.score', compact('targets', 'exams', 'citys', 'cycles', 'data', 'classroom'));
    }

    public function scoreExport($exam_id, $classroom_id)
    {
        $data['exam_id'] = $exam_id;
        $data['classroom_id'] = $classroom_id;

        $exam = Exam::find($exam_id);
        $classroom = Classroom::find($classroom_id);

        $file_name = $classroom->cycle->name . '年度' . $classroom->school->fullName() . $classroom->fullName() . $exam->name . '滿分' . array_sum($exam->total_score()) . '分成績表';
        return Excel::download(new ScoreExport($data), $file_name . '.xlsx');
    }

    public function scoreDetail($exam_id, $classroom_id)
    {
        //
        $targets = config('map.target');

        $user_ids = User::student()->where('classroom_id', $classroom_id)->get()->pluck('id')->toArray();

        $exam = Exam::find($exam_id);
        $count = $exam->score_count();
        $user_exams = UserExam::whereIn('user_id', $user_ids)->where('exam_id', $exam_id)->get();
        foreach ($user_exams as $user_exam) {
            if (!$user_exam->user) {
                continue;
            }
            $user_exam->score_array = $this->calScore($user_exam->score, $count);
        }

        return view('exams.score-detail', compact('targets', 'user_exams', 'exam'));
    }

    public function studentScore(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();
        $targets = config('map.target');

        $exam_id_array = UserExam::where('user_id', $user->id)->get()->pluck('exam_id')->toArray();

        $exams = $user->classroom->exams->whereIn('id', $exam_id_array)->all();

        return view('exams.student-score', compact('targets', 'exams', 'data'));
    }

    public function my(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();
        $targets = config('map.target');

        $exams = Exam::where('user_id', $user->id)->get();
        if ($user->role == 9) {
            $classrooms = Classroom::all();
        } else {
            $classrooms = $user->teacher_classroom();
        }

        $citys = $this->getSchool();

        return view('exams.view', compact('targets', 'exams', 'classrooms', 'citys', 'user', 'data'));
    }

    public function studentView(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();
        $targets = config('map.target');

        $exam_id_array = UserExam::where('user_id', $user->id)->get()->pluck('exam_id')->toArray();

        $exams = $user->classroom->exams->whereNotIn('id', $exam_id_array)->all();

        return view('exams.student-view', compact('exams', 'targets', 'data'));
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
        $user = Auth::user();
        $targets = config('map.target');

        if ($user->role == 9) {
            $exams = Exam::all();
        } else {
            $exams = Exam::where('status', 1)->get();
        }

        //$classrooms = $user->teacher_classroom();
        $classrooms = [];
        $citys = $this->getSchool();

        return view('exams.view', compact('exams', 'targets', 'classrooms', 'citys', 'user', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *,''
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = Auth::user();
        $myUnits = Unit::where('user_id', $user->id)->get();

        $openUnits = Unit::where('status', 1)->where('user_id', "!=", $user->id)->get();

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
            'unit_id' => $data['unit_id'],
            'user_id' => $user->id
        ]);
        $model->save();

        return redirect('exams/my');
        /*
        if ($user->role == 9) {
            return redirect('exams');
        } else {
            return redirect('exams/my');
        }
        */
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
        $user = Auth::user();
        $myUnits = Unit::where('user_id', $user->id)
            ->whereNotIn('id', $exam->unit_id)
            ->get();

        $openUnits = Unit::where('is_open', 1)
            ->where('user_id', "!=", $user->id)
            ->whereNotIn('id', $exam->unit_id)
            ->get();

        $selected = Unit::whereIn('id', $exam->unit_id)->get();

        return view('exams.create', compact('exam', 'myUnits', 'openUnits', 'selected'));
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
        $data = $request->except('_token');
        $user = Auth::user();

        $exam->fill([
            'name' => $data['name'],
            'unit_id' => $data['unit_id']
        ]);
        $exam->save();

        if ($user->role == 9) {
            return redirect('exams');
        } else {
            return redirect('exams/my');
        }
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
        $exam->delete();
        return back();
    }
}
