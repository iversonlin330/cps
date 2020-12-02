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
}
