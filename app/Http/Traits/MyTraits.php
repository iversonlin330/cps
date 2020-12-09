<?php

namespace App\Http\Traits;

use App\Cycle;
use App\School;
use App\User;
use App\Task;

trait MyTraits
{

    public function getCity()
    {
        $schools = array_map('str_getcsv', file('e1_new.csv'));
        unset($schools[0]);

        $citys = [];
        foreach ($schools as $school) {
            $citys[substr($school[3], 4, 9)][] = $school[1];
        }
        return $citys;
    }

    public function getSchool()
    {

        $schools = School::all();

        $citys = [];
        foreach ($schools as $school) {
            $citys[$school->city][$school->id] = $school->name;
        }

        return $citys;
    }

    public function getStudentNow()
    {
        $cycle = Cycle::latest()->first();
        return User::Student()->where('cycle_id', $cycle->id)->get();
    }

    public function getStudentNowByClass($classroom_id)
    {
        $cycle = Cycle::latest()->first();
        return User::Student()->where('cycle_id', $cycle->id)->where('classroom_id', $classroom_id)->get();
    }

    public function getStudentNowNoClass($school_id)
    {
        $cycle = Cycle::latest()->first();
        return User::Student()->where('cycle_id', $cycle->id)
            ->whereNull('classroom_id')
            ->where('school_id', $school_id)
            ->get();
    }

    public function getTargetInitial()
    {
        $targets = config('map.target');
        $result = [];
        foreach ($targets as $target_id => $value) {
            $result[$target_id] = 0;
        }
        return $result;
    }

    //算分數
    public function calScore($answer, $count)
    {
        $result = $this->getTargetInitial();
        /*
        foreach ($answer as $task_id => $question) {
            $task = Task::find($task_id);
            foreach ($question as $q_id => $score) {
                $target_id = $task->content['target'][$q_id];
                $result[$target_id] = $result[$target_id] + $score;
            }
        }
        */
        foreach ($answer as $task_id => $question) {
            $task = Task::find($task_id);
            foreach ($question as $index => $score_array) {
                $target_id = $task->content['target'][$index];
                if (is_array($score_array)) {
                    $result[$target_id] = $result[$target_id] + array_sum($score_array);
                } else {
                    $result[$target_id] = $result[$target_id] + $score_array;
                }
            }
        }

        foreach ($result as $k => $v) {
            if ($count[$k] != 0) {
                $result[$k] = round($v / $count[$k], 1);
            }
        }

        return $result;
    }
}
