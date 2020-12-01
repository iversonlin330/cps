<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//        'name', 'email', 'password',
//    ];

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
//    protected $hidden = [
//        'password', 'remember_token',
//    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //'tutor_classroom_id' => 'array',
        'subject_classroom_id' => 'array',
    ];

    //訪客-1 窗口-2 學生-3 老師-4 管理員-9
    public function scopeGuest($query)
    {
        return $query->where('role', 1);
    }

    public function scopeContact($query)
    {
        return $query->where('role', 2);
    }

    public function scopeStudent($query)
    {
        return $query->where('role', 3);
    }

    public function scopeTeacher($query)
    {
        return $query->where('role', 4);
    }

    public function scopeAdmin($query)
    {
        return $query->where('role', 9);
    }

    public function scopeNow($query)
    {
        $cycle = Cycle::latest()->first();
        return $query->where('cycle_id', $cycle->id);
    }

    public function subject_classroom()
    {
        if(!$this->subject_classroom_id){
            $this->subject_classroom_id = [];
        }
        return Classroom::whereIn('id', $this->subject_classroom_id)->get();
    }
	
	public function teacher_classroom()
    {
        if(!$this->subject_classroom_id){
            $this->subject_classroom_id = [];
        }
        return Classroom::whereIn('id', $this->subject_classroom_id)
			->orWhere('id',$this->tutor_classroom_id)->get();
    }

    public function classrooms()
    {
        return $this->hasMany('\App\Classroom', 'user_id');
    }

    public function classroom()
    {
        return $this->hasOne('\App\Classroom', 'id', 'classroom_id');
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
