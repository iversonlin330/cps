<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Cycle;
use App\Http\Traits\MyTraits;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassroomController extends Controller
{
    use MyTraits;

    public function teacherView()
    {
        $user = Auth::user();
        $classroom_selects = $user->subject_classroom();
        $classrooms = Classroom::where('school_id', $user->school_id)
            ->whereNotIn('id', $user->subject_classroom_id)
            ->get();
			
		$classroom_tutors = $user->tutor_classroom();

        return view('classrooms.teacher-view', compact('classrooms', 'classroom_selects', 'user','classroom_tutors'));
    }
	
	public function teacherDetailView($classroom_id)
    {
        $classroom = Classroom::find($classroom_id);

        return view('classrooms.teacher-detail-view', compact('classroom'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        $cycle = Cycle::latest()->first();
        $classrooms = Classroom::where('school_id', $user->school_id)->where('cycle_id', $cycle->id)->get();

        return view('classrooms.view', compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = Auth::user();
        $school_id = $user->school_id;
        $students = $this->getStudentNowNoClass($school_id);

        return view('classrooms.create', compact('students'));
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
        $data = $request->all();
        $user = Auth::user();
        $cycle = Cycle::latest()->first();

        $model = new Classroom;
        $model->fill([
            'grade' => $data['grade'],
            'class' => $data['class'],
            'cycle_id' => $cycle->id,
            'school_id' => $user->school_id,
			'user_id' => $user->id
        ]);
        $model->save();

        $classroom_id = $model->id;

        User::whereIn('id', $data['student_id'])->update(['classroom_id' => $classroom_id]);

        return redirect('classrooms');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Classroom $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Classroom $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        //
        $user = Auth::user();
        $school_id = $user->school_id;
        $students = $this->getStudentNowNoClass($school_id);

        $selected = User::student()->where('classroom_id', $classroom->id)->get();

        return view('classrooms.create', compact('classroom', 'students', 'selected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Classroom $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
        //
        $data = $request->except(['_token', 'city_id']);
        $classroom->fill([
            'grade' => $data['grade'],
            'class' => $data['class'],
        ]);
        $classroom->save();

        $classroom_id = $classroom->id;

        User::whereIn('id', $data['student_id'])->update(['classroom_id' => $classroom_id]);

        return redirect('classrooms');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Classroom $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        //
        $classroom->delete();
        return back();
    }
}
