<?php

namespace App\Http\Traits;

use App\Cycle;
use App\School;
use App\User;

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
}
