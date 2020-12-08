<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserExam extends Model
{
    //
	protected $table = 'user_exam';
    protected $guarded = ['id'];

    protected $casts = [
        'score' => 'array'
    ];

    public function exam()
    {
        return $this->hasOne('\App\Exam', 'id', 'exam_id');
    }

    public function user()
    {
        return $this->hasOne('\App\User', 'id', 'user_id');
    }

}
