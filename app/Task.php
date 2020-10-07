<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //

    protected $guarded =['id'];

    protected $casts = [
        'content' => 'array'
    ];

    public function maxScore()
    {
        $this->content;
        return 5;
    }
}
