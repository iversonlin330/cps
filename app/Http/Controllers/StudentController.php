<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Cycle;
use App\Http\Traits\MyTraits;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{
    use MyTraits;

    private function getAccount($school_id)
    {
        $cycle = Cycle::latest()->first();

        $user = User::where('school_id', $school_id)->where('cycle_id', $cycle->id)->orderBy('id', 'desc')->first();

        if ($user) {
            return $user->account + 1;
        } else {
            $new_school_id = str_pad($school_id, 3, '0', STR_PAD_LEFT);
            return $cycle->name . $new_school_id . "001";
        }
    }

    public function apply()
    {
        //
        return view('students.apply');
    }

    public function postApply(Request $request)
    {
        $user = Auth::user();
        $number = $request->get('number');

        $content = "管理員您好：\n" .
            $user->school->fullName() . "的窗口（" . $user->account . "）向您申請" . $number . "位學生，煩請協助辦理，謝謝。";

        $to = explode(',', env('MAIL_TO'));

        Mail::raw($content, function ($message) use ($to) {
            //$message->from('test@gmail');
            $message->to($to);
        });

        return back();
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

        if (!$data) {
            $data['cycle_id'] = Cycle::latest()->first()->id;
        }

        unset($data['city_id']);

        $users = User::Student()
            ->where('cycle_id',$data['cycle_id'])
            ->where(function ($query) use ($data) {
                if ($data) {
                    foreach ($data as $k => $v) {
                        if($k == "cycle_id")
                            continue;
                        if ($v) {
                            $query->orWhere($k, 'like', '%' . $v . '%');
                        }
                    }
                }
            })
            ->get();
        $citys = $this->getSchool();

        $cycles = Cycle::orderBy('id', 'desc')->get();

        return view('students.view', compact('users', 'citys', 'cycles', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //
        $citys = $this->getSchool();

        $classroom_map = Classroom::now()->get()->groupBY('school_id');

        /*
        foreach ($classroom_map as $k =>$v){
            $classroom_map[$k];
        }
*/
        return view('students.create', compact('citys', 'classroom_map'));
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
        $classroom_map = Classroom::now()->get()->groupBY('school_id');

        return view('students.create', compact('user', 'citys', 'classroom_map'));
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
        return redirect('students');
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
