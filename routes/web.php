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

Route::get('/login', 'LoginController@login');
Route::post('/login', 'LoginController@login');

Route::get('/main', 'LoginController@main');
Route::get('/exams/score', 'ExamController@score');
Route::get('/exams/start', 'ExamController@start');
Route::get('/exams/result', 'ExamController@result');
Route::get('/units/start', 'UnitController@start');
Route::get('/units/result', 'UnitController@result');

Route::resource("users", "UserController");
Route::resource("cycles", "CycleController");
Route::resource("classrooms", "ClassroomController");
Route::resource("exams", "ExamController");
Route::resource("units", "UnitController");
Route::resource("tasks", "TaskController");
Route::resource("contacts", "ContactController");

Route::get('/teachers/verify', 'TeacherController@verify');
Route::resource("teachers", "TeacherController");
Route::get('/students/create-multi', 'StudentController@createMulti');
Route::resource("students", "StudentController");


