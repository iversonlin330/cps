<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\MyTraits;
use App\UserExam;

class Exam extends Model
{
	use MyTraits;

    protected $guarded = ['id'];

    protected $casts = [
        'unit_id' => 'array'
    ];

    public function units()
    {
        return Unit::whereIn('id',$this->unit_id)->get();

        return $this->belongsToMany('App\Unit')->orderBy('order', 'desc');
    }
	
	public function score_count(){
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
		
        $user_scores = UserExam::where('exam_id', $this->id)
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
		
		return $avg;
    }
}
