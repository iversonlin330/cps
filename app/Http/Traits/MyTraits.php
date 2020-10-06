<?php

namespace App\Http\Traits;

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
}
