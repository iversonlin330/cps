<?php

namespace App\Http\Controllers;

use App\Cycle;
use App\Http\Traits\MyTraits;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    use MyTraits;

    private function getAccount($school_id)
    {
        $cycle = Cycle::latest()->first();

        $user = User::where('school_id', $school_id)->where('cycle_id', $cycle->id)->orderBy('id','desc')->first();

        if ($user) {
            return $user->account + 1;
        } else {
            $new_school_id = str_pad($school_id, 3, '0', STR_PAD_LEFT);
            return $cycle->name . $new_school_id . "001";
        }
    }

    public function createMulti()
    {
        //
        $citys = $this->getSchool();
        return view('students.create-multi', compact('citys'));
    }

    public function postCreateMulti(Request $request)
    {
        //
        $cycle = Cycle::latest()->first();
        $data = $request->except('_token');

        for ($i = 0; $i <= $data['number']; $i++) {
            $temp = [];
            $account = $this->getAccount($data['school_id']);
            $temp['cycle_id'] = $cycle->id;
            $temp['school_id'] = $data['school_id'];
            $temp['role'] = 3;
            $temp['gender'] = 1;
            $temp['is_local'] = 0;
            $temp['account'] = $account;
            $temp['password'] = $account;

            $model = new User;
            $model->fill($temp);
            $model->save();
        }

        return redirect('students');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data = $request->all();

        unset($data['city_id']);

        $users = User::Student()
            ->where(function ($query) use ($data) {
                if ($data) {
                    foreach ($data as $k => $v) {
                        if ($v) {
                            $query->orWhere($k, 'like', '%' . $v . '%');
                        }
                    }
                }
            })
            ->get();
        $citys = $this->getSchool();

        $cycles = Cycle::all();

        return view('students.view', compact('users', 'citys', 'cycles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $citys = $this->getSchool();
        return view('students.create', compact('citys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->except(['_token', 'city_id']);

        $account = $this->getAccount($data['school_id']);
        $data['account'] = $account;
        $data['password'] = $account;

        $model = new User;
        $model->fill($data);
        $model->save();
        return redirect('students');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Teacher $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Teacher $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::find($id);
        $citys = $this->getSchool();

        $user->school_id = $user->school->id;
        $user->city_id = $user->school->city;

        return view('students.create', compact('user', 'citys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Teacher $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Teacher $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}
