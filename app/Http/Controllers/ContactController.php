<?php

namespace App\Http\Controllers;

use App\School;
use App\User;
use Illuminate\Http\Request;
use App\Http\Traits\MyTraits;

class ContactController extends Controller
{

    use MyTraits;

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

        $users = User::contact()
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

        return view("contacts.view", compact('users', 'citys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $citys = $this->getCity();
        return view("contacts.create", compact('citys'));
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
        $data = $request->except('_token');

        $school = School::firstOrCreate(['city' => $data['city_id'], 'name' => $data['school_id']]);

        unset($data['city_id']);
        $data['school_id'] = $school->id;

        $model = new User;
        $model->fill($data);
        $model->save();

        return redirect('contacts');
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
        $user = User::find($id);
        $citys = $this->getCity();

        $user->school_id = $user->school->name;
        $user->city_id = $user->school->city;

        return view('contacts.create', compact('user','citys'));
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
        $data = $request->except('_token');

        $school = School::firstOrCreate(['city' => $data['city_id'], 'name' => $data['school_id']]);

        unset($data['city_id']);
        $data['school_id'] = $school->id;

        $model = User::find($id);
        $model->fill($data);
        $model->save();
        return redirect('contacts');
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
        $user = User::where('id', $id)->first();
        $user->delete();
        return back();
    }
}
