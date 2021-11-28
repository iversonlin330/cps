<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Http\Traits\MyTraits;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use MyTraits;

    public function teacherRegister()
    {
        $user = Auth::user();
        $citys = $this->getSchool();

        return view("users.teacher-register", compact('citys'));
    }

    public function postTeacherRegister(Request $request)
    {
        //
        $data = $request->except(['_token', 'city_id']);
        $model = new User;
        $model->fill($data);
        $model->save();
        return redirect('/');
    }

    public function contactEdit()
    {
        $user = Auth::user();

        return view("users.contact-edit", compact('user'));
    }

    public function teacherEdit()
    {
        $user = Auth::user();
        $citys = $this->getSchool();

        return view("users.teacher-edit", compact('user', 'citys'));
    }

    public function contactTeachersEdit()
    {
        $user = Auth::user();

        $users = User::teacher()->where('school_id', $user->school_id)->get();

        foreach ($users as $user) {
            if (is_null($user->tutor_classroom_id)) {
                $user->tutor_classroom_id = [];
            }
        }

        $classrooms = Classroom::now()->where('school_id', $user->school_id)->get();

        return view("users.contact-teachers-edit", compact('users', 'classrooms'));
    }

    public function postContactTeachersEdit(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();
        $classroom_ids = Classroom::now()->where('school_id', $user->school_id)->get()->pluck('id')->toArray();

        foreach ($data['teacher_array'] as $k => $v) {
            $tutor_classroom_id = User::find($k)->tutor_classroom_id;
            if (is_null($tutor_classroom_id)) {
                $tutor_classroom_id = [];
            }

            foreach ($tutor_classroom_id as $key => $val) {
                if (in_array((int)$val, $classroom_ids)) {
                    unset($tutor_classroom_id[$key]);
                }
            }

            $tutor_classroom_id = array_values($tutor_classroom_id);

            if (is_null($v['tutor_classroom_id'])) {
                $v['tutor_classroom_id'] = $tutor_classroom_id;
            } else {
                $tutor_classroom_id[] = $v['tutor_classroom_id'];
                $v['tutor_classroom_id'] = $tutor_classroom_id;
            }

            //$v['tutor_classroom_id'] = array_merge($tutor_classroom_id, $v['tutor_classroom_id']);

            User::where('id', $k)->update($v);
        }

        return back();
    }

    public function contactStudentsEdit($classroom_id)
    {
        $users = Auth::user();

        $students = User::student()->where('classroom_id', $classroom_id)->get();

        $classroom = Classroom::find($classroom_id);

        return view("users.contact-students-edit", compact('users', 'students', 'classroom'));
    }

    public function postContactStudentsEdit(Request $request)
    {
        $data = $request->all();

        foreach ($data['student_array'] as $k => $v) {
            User::where('id', $k)->update($v);
        }

        return back();
    }

    public function postAddClass(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();

        $array = $user->subject_classroom_id;

        if (!$array) {
            $array = [];
        }

        array_push($array, $data['subject_classroom_id']);

        $user->fill(['subject_classroom_id' => $array])->save();

        return back();
    }

    public function removeClass($classroom_id)
    {
        $user = Auth::user();

        $array = $user->subject_classroom_id;

        if (!$array) {
            $array = [];
        }

        if (($key = array_search($classroom_id, $array)) !== false) {
            unset($array[$key]);
        }

        $user->fill(['subject_classroom_id' => $array])->save();

        return back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::first();
        Auth::login($user);
        dd(Auth::user());
        dd(Auth::check());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        $model = new User;
        $model->fill($data);
        $model->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = $request->except('_method', '_token');

        $model = User::find($id);
        $model->fill($data);
        $model->save();

        return redirect('main');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        User::find($id)->delete();
        return back();
    }
}
