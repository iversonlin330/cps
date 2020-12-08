<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\MyTraits;
use App\UserUnit;
use Illuminate\Support\Facades\Auth;

class Unit extends Model
{
    use MyTraits;

	protected $guarded = ['id'];

    public function tasks()
    {
        return $this->hasMany('\App\Task')->orderBy('order');
    }

	public function score_count(){
		$count = $this->getTargetInitial();
		$tasks = $this->tasks;
        foreach ($tasks as $task) {
            $count_list = array_count_values($task->content['target']);
            foreach ($count_list as $k => $v) {
                $count[$k] = $count[$k] + $v;
            }
        }

		return $count;
	}

    public function my_score()
    {
        $user = Auth::user();
        $avg = $this->getTargetInitial();
        $count = $this->score_count();

        $user_scores = UserUnit::where('unit_id', $this->id)
            ->where('user_id', $user->id)
            ->get();
        if ($user_scores->count() > 0) {
            foreach ($user_scores as $user_score) {
                $avg = $this->calScore($user_score->score, $count);
            }

            foreach ($avg as $k => $v) {
                if ($count[$k] != 0) {
                    $avg[$k] = round($v / 1, 1);
                }
            }
        }

        return $avg;
    }

    public function avg_score()
    {
        $students = $this->getStudentNow();
		$avg = $this->getTargetInitial();
        $count = $this->score_count();

		//if(!$students){
		//	return 0;
		//}

        $user_scores = UserUnit::where('unit_id', $this->id)
            ->whereIn('user_id', $students->pluck('id')->toArray())
            ->get();
        if ($user_scores->count() > 0) {
            foreach ($user_scores as $user_score) {
                $avg = $this->calScore($user_score->score, $count);
            }

            foreach ($avg as $k => $v) {
                if ($count[$k] != 0) {
                    $avg[$k] = round($v / $user_scores->count(), 1);
                }
            }
        }

		return $avg;
    }

    public function total_score()
    {
        $total = $this->getTargetInitial();
		$count = $this->score_count();
		$tasks = $this->tasks;

        foreach ($tasks as $task) {
            $q_id = 0;
            foreach ($task->content['count'] as $index => $q_count) {
                $target = $task->content['target'][$index];
                $max_temp = 0;
                for ($sub = 0; $sub < $q_count; $sub++) {
                    if ($task->content['is_item'][$q_id] == 1) {
                        if (max($task->content['score'][$q_id]) > $max_temp) {
                            $max_temp = max($task->content['score'][$q_id]);
                        }
                    }
                    $q_id++;
                }
                $total[$target] = $total[$target] + $max_temp;
            }
        }

        foreach ($total as $k => $v) {
            if ($count[$k] != 0) {
                $total[$k] = round($v / $count[$k], 1);
            }
        }

		return $total;
    }
}
