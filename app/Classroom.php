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
        return $this->hasMany('\App\User', 'classroom_id')->where('role',3);
    }

    public function teacher()
    {
        return $this->belongsTo('\App\User', 'teacher_id', 'id');
    }

    public function exams()
    {
        return $this->belongsToMany('\App\Exam');
    }
}
