<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::post('/login', 'LoginController@login');

Route::resource("users", "UserController");
Route::resource("cycles", "CycleController");
Route::resource("classrooms", "ClassroomController");
Route::resource("exams", "ExamController");
Route::resource("units", "UnitController");


