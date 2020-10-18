<?php

namespace App\Http\Controllers;

use App\Cycle;
use Illuminate\Http\Request;

class CycleController extends Controller
{
    public function newCycle()
    {
        //
		$cycle = Cycle::orderby('created_at', 'desc')->first();
		
		//$new_cycle = $cycle_name = (date("yy") - 1911)."1";
		
		$new_cycle = (date("yy") - 1911).(substr($cycle->name,-1)+1);
		
		$model = new Cycle;
		$model->name = $new_cycle;
		$model->save();
		
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("cycles.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        unset($data['_token']);
        $cycle = new Cycle;
        $cycle->fill($data);
        $cycle->save();

        return redirect("cycles");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cycle  $cycle
     * @return \Illuminate\Http\Response
     */
    public function show(Cycle $cycle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cycle  $cycle
     * @return \Illuminate\Http\Response
     */
    public function edit(Cycle $cycle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cycle  $cycle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cycle $cycle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cycle  $cycle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cycle $cycle)
    {
        //
    }
}
