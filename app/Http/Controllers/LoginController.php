<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        $data = $request->all();
        $user = User::where('account', $data['account'])->first();

        if (!$user) {
            return back();
        }

        if ($user->role == 1) {
            $user = User::where('account', $data['account'])->first();
            Auth::login($user);
            dd(Auth::user());
            if ($user->user_info) {
                return redirect('groups');
            } else {
                return redirect('students/create');
            }
        } elseif ($user->role == 50) {
            //$credentials = $request->only('account', 'password');
            //if(Auth::attempt($credentials)){
            $credentials = User::where('account', $data['account'])
                ->where('password', $data['password'])
                ->first();
            if ($credentials) {
                Auth::login($credentials);
                $user = Auth::user();
                if ($user->user_info) {
                    return redirect('groups');
                } else {
                    return redirect('teachers/create');
                }
            } else {
                return back();
            }
        } elseif ($user->role == 99) {
            //$credentials = $request->only('account', 'password');
            //if(Auth::attempt($credentials)){
            $credentials = User::where('account', $data['account'])
                ->where('password', $data['password'])
                ->first();
            if ($credentials) {
                Auth::login($credentials);
                return redirect('groups');
            } else {
                return back();
            }
        } else {
            $credentials = $request->only('account', 'password');
            if (Auth::attempt($credentials)) {
                return redirect('groups');
            } else {
                return back();
            }
        }

    }

    public function main(Request $request)
    {
        return view("main");
    }
}
