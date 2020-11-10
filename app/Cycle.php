<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
    //
    protected $guarded = ["id"];

    public function classrooms()
    {
        return $this->hasMany('\App\Classroom');
    }

	public function getRange(){
		$new = Cycle::where('id','>',$this->id)->first();

		if($new){
			return $this->created_at->format('Y/m/d') . '~' . $new->created_at->format('Y/m/d');
		}else{
			return $this->created_at->format('Y/m/d') . '~now' ;
		}

	}

}
