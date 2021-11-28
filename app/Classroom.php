<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    //
    protected $guarded = ['id'];

    public function scopeNow($query)
    {
        $cycle = Cycle::latest()->first();
        return $query->where('cycle_id', $cycle->id);
    }

    public function fullName()
    {
        return $this->grade . '年' . $this->class . '班';
    }

    public function students()
    {
        return $this->hasMany('\App\User', 'classroom_id')->where('role', 3);
    }

    public function teacher()
    {
        $users = User::whereNotNull('tutor_classroom_id')->get();
        foreach ($users as $user) {
            if (in_array($this->id, $user->tutor_classroom_id)) {
                return $user;
            }
        }
        //return $this->belongsTo('\App\User', 'tutor_classroom_id', 'id');
    }

    public function exams()
    {
        return $this->belongsToMany('\App\Exam');
    }

    public function school()
    {
        return $this->hasOne('\App\School', 'id', 'school_id');
    }

    public function cycle()
    {
        return $this->hasOne('\App\Cycle', 'id', 'cycle_id');
    }
}
