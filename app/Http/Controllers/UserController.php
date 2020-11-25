<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function contactEdit()
    {
        $user = Auth::user();

        return view("users.contact-edit", compact('user'));
    }

    public function contactTeachersEdit()
    {
        $user = Auth::user();

        $users = User::teacher()->where('school_id', $user->school_id)->get();

        $classrooms = Classroom::now()->where('school_id', $user->school_id)->get();

        return view("users.contact-teachers-edit", compact('users', 'classrooms'));
    }

    public function postContactTeachersEdit(Request $request)
    {
        $data = $request->all();

        foreach ($data['teacher_array'] as $k => $v) {
            User::where('id', $k)->update($v);
        }

        return back();
    }

    public function contactStudentsEdit($classroom_id)
    {
        $users = Auth::user();

        $students = User::student()->where('classroom_id', $classroom_id)->get();

		$classroom = Classroom::find($classroom_id);

        return view("users.contact-students-edit", compact('users', 'students','classroom'));
    }

    public function postContactStudentsEdit(Request $request)
    {
        $data = $request->all();

        foreach ($data['student_array'] as $k => $v) {
            User::where('id', $k)->update($v);
        }

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
    }
}
