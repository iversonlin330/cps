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
Route::get('/logout', 'LoginController@logout');

Route::post('/newCycle', 'CycleController@newCycle');
Route::get('/main', 'LoginController@main');
Route::get('/exams/score', 'ExamController@score');
Route::get('/exams/score-detail', 'ExamController@scoreDetail');
Route::get('/exams/start/{id}', 'ExamController@start');
Route::post('/exams/start/{id}', 'ExamController@postStart');
Route::get('/exams/result', 'ExamController@result');
Route::post('/exams/order', 'ExamController@order');
Route::get('/exams/student-view', 'ExamController@studentView');

Route::get('/units/start/{id}', 'UnitController@start');
Route::post('/units/start/{id}', 'UnitController@postStart');
Route::get('/units/result', 'UnitController@result');
Route::get('/units/copy/{id}', 'UnitController@copy');
Route::get('/units/student-view', 'UnitController@studentView');
Route::get('/units/student-score', 'UnitController@studentScore');

Route::post('/tasks/{id}', 'TaskController@updateStr');
Route::get('/tasks/start/{id}', 'TaskController@start');
Route::post('/tasks/start/{id}', 'TaskController@postStart');
Route::get('/tasks/copy/{id}', 'TaskController@copy');

Route::get('/students/create-multi', 'StudentController@createMulti');
Route::get('/students/apply', 'StudentController@apply');
Route::post('/students/create-multi', 'StudentController@postCreateMulti');

Route::get('/users/contact-edit', 'UserController@contactEdit');
Route::get('/users/contact-teachers-edit', 'UserController@contactTeachersEdit');
Route::get('/users/contact-students-edit/{classroom_id}', 'UserController@contactStudentsEdit');
Route::post('/users/contact-students-edit', 'UserController@postContactStudentsEdit');

Route::get("/classrooms/teacher-view", "ClassroomController@teacherView");


Route::resource("users", "UserController");
Route::resource("cycles", "CycleController");
Route::resource("classrooms", "ClassroomController");
Route::resource("exams", "ExamController");
Route::resource("units", "UnitController");
Route::resource("tasks", "TaskController");
Route::resource("contacts", "ContactController");

Route::get('/teachers/verify', 'TeacherController@verify');
Route::resource("teachers", "TeacherController");
Route::resource("students", "StudentController");


