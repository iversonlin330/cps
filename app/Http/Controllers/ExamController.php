<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function order()
    {
        //
        return redirect('exams');
    }

    public function start()
    {
        //
        return view('exams.start');
    }

    public function result()
    {
        //
        $id = 1;
        $exam = Exam::find($id);
        $exam->units;
        foreach ($exam->units as $unit) {
            dd($unit->tasks);
        }
        dd($exam->units);
        return view('exams.result');
    }

    public function score()
    {
        //
        $targets = config('map.target');
        return view('exams.score', compact('targets'));
    }

    public function scoreDetail()
    {
        //
        $targets = config('map.target');
        return view('exams.score-detail', compact('targets'));
    }

    public function my()
    {
        //
        return view('exams.my');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $targets = config('map.target');

        $exams = Exam::all();

        return view('exams.view', compact('exams', 'targets'));
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
        $myUnits = Unit::where('user_id', $user->id)->get();

        $openUnits = Unit::where('is_open', 1)->get();

        return view('exams.create', compact('myUnits', 'openUnits'));
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
        $data = $request->except('_token');

        $user = Auth::user();

        $model = new Exam;
        $model->fill([
            'name' => $data['name'],
            'user_id' => $user->id
        ]);
        $model->save();

        //$model->units()->attach($data['unit_id']);

        return view('exams.create-order');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        //
    }
}
