<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserUnit extends Model
{
    //
	protected $table = 'user_unit';
    protected $guarded = ['id'];

    protected $casts = [
        'score' => 'array'
    ];
}
