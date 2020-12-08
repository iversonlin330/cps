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

    public function unit()
    {
        return $this->hasOne('\App\Unit', 'id', 'unit_id');
    }

    public function user()
    {
        return $this->hasOne('\App\User', 'id', 'user_id');
    }

}
