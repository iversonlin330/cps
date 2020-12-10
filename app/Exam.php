<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\MyTraits;
use Illuminate\Support\Facades\Auth;

class Exam extends Model
{
    use MyTraits;

    protected $guarded = ['id'];

    protected $casts = [
        'unit_id' => 'array'
    ];

    public function is_answer()
    {
        $count = UserExam::where('exam_id', $this->id)->count();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function units()
    {
        $ids_ordered = implode(',', $this->unit_id);
        return Unit::whereIn('id', $this->unit_id)->orderByRaw("FIELD(id, $ids_ordered)")->get();

        return $this->belongsToMany('App\Unit')->orderBy('order', 'desc');
    }

    public function score_count()
    {
        $count = $this->getTargetInitial();
        $units = $this->units();
        foreach ($units as $unit) {
            $tasks = $unit->tasks;
            foreach ($tasks as $task) {
                $count_list = array_count_values($task->content['target']);
                foreach ($count_list as $k => $v) {
                    $count[$k] = $count[$k] + $v;
                }
            }
        }
        return $count;
    }

    public function total_score()
    {
        $total = $this->getTargetInitial();
        $count = $this->score_count();
        $units = $this->units();

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

        return $total;
    }

    public function avg_score()
    {
        $students = $this->getStudentNow();
        $avg = $this->getTargetInitial();
        $count = $this->score_count();

        $user_scores = UserExam::where('exam_id', $this->id)
            ->whereIn('user_id', $students->pluck('id')->toArray())
            ->get();
        if ($user_scores->count() > 0) {
            foreach ($user_scores as $user_score) {
                $avg = $this->calScore($user_score->score, $count);
            }

            foreach ($avg as $k => $v) {
                if ($count[$k] != 0) {
                    $avg[$k] = round($v / $user_scores->count(), 1);
                    //$avg_score = $avg_score + $avg[$k];
                }
            }
        }

        return $avg;
    }

    public function avg_class_score($classroom_id)
    {
        $students = $this->getStudentNow()->where('classroom_id', $classroom_id);
        $avg = $this->getTargetInitial();
        $count = $this->score_count();

        $user_scores = UserExam::where('exam_id', $this->id)
            ->whereIn('user_id', $students->pluck('id')->toArray())
            ->get();
        if ($user_scores->count() > 0) {
            foreach ($user_scores as $user_score) {
                $avg = $this->calScore($user_score->score, $count);
            }

            foreach ($avg as $k => $v) {
                if ($count[$k] != 0) {
                    $avg[$k] = round($v / $user_scores->count(), 1);
                    //$avg_score = $avg_score + $avg[$k];
                }
            }
        }

        return $avg;
    }

    public function my_score()
    {
        $user = Auth::user();
        //$students = $this->getStudentNow();
        $avg = $this->getTargetInitial();
        $count = $this->score_count();

        $user_scores = UserExam::where('exam_id', $this->id)
            ->where('user_id', $user->id)
            ->get();
        if ($user_scores->count() > 0) {
            foreach ($user_scores as $user_score) {
                $avg = $this->calScore($user_score->score, $count);
            }

            foreach ($avg as $k => $v) {
                if ($count[$k] != 0) {
                    $avg[$k] = round($v / 1, 1);
                    //$avg_score = $avg_score + $avg[$k];
                }
            }
        }

        return $avg;
    }

    public function classrooms()
    {
        return $this->belongsToMany('\App\Classroom');
    }
}
