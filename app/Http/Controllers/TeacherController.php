<?php

namespace App\Http\Controllers;

use App\Http\Traits\MyTraits;
use App\School;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    use MyTraits;

    public function verify(Request $request)
    {
        //
		$citys = $this->getSchool();
		$data = $request->all();

        unset($data['city_id']);

        $users = User::Teacher()
            ->where(function ($query) use ($data) {
                if ($data) {
                    foreach ($data as $k => $v) {
                        if ($v) {
                            $query->orWhere($k, 'like', '%' . $v . '%');
                        }
                    }
                }
            })
			->where('is_verify',0)
            ->get();
		
        return view('teachers.verify', compact('citys','users'));
    }
	
	public function postVerify(Request $request)
    {
        $data = $request->all();

        foreach ($data['teacher_array'] as $k => $v) {
            User::where('id', $k)->update($v);
        }

        return back();
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

        $users = User::Teacher()
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
        return view('teachers.view', compact('users', 'citys'));
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
        return view('teachers.create', compact('citys'));
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

        $model = new User;
        $model->fill($data);
        $model->save();

        return redirect('teachers');
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

        return view('teachers.create', compact('user', 'citys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Teacher $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = $request->except(['_token', 'city_id']);
        $model = User::find($id);
        $model->fill($data);
        $model->save();
        return redirect('teachers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Teacher $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::where('id', $id)->first();
        $user->delete();
        return back();
    }
}
