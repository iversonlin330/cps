<?php

namespace App\Http\Traits;

use App\Cycle;
use App\School;
use App\User;
use App\Task;

trait MyTraits {
	
    public function getCity() {
        $schools = array_map('str_getcsv', file('e1_new.csv'));
        unset($schools[0]);

        $citys = [];
        foreach ($schools as $school) {
            $citys[substr($school[3], 4, 9)][] = $school[1];
        }
        return $citys;
    }

    public function getSchool() {

        $schools = School::all();

        $citys = [];
        foreach ($schools as $school) {
            $citys[$school->city][$school->id] = $school->name;
        }

        return $citys;
    }

    public function getStudentNow(){

        $cycle = Cycle::latest()->first();
        return User::Student()->where('cycle_id',$cycle->id)->get();
    }
	
	public function getTargetInitial(){
		$targets = config('map.target');
		$result = [];
		foreach ($targets as $target_id => $value) {
            $result[$target_id] = 0;
        }
		return $result;
	}
	
	//算分數
	public function calScore($answer,$count){
		$result = $this->getTargetInitial();
		foreach ($answer as $task_id => $question) {
            $task = Task::find($task_id);
            foreach ($question as $q_id => $score) {
                $target_id = $task->content['target'][$q_id];
                $result[$target_id] = $result[$target_id] + $score;
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
