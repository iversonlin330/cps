@extends('layouts.master')
@section('title1', '班級資料設定')
@section('title2', '資料設定 / 班級資料設定')
@section('content')
    <div class="row main-padding mb-2">
        <div class="col-12">
            <div class="float-left">
                <a class="btn btn-warning" data-toggle="modal" data-target="#addModal">新增班級</a>
            </div>
            <div class="float-right">
                <form action="{{ url('classrooms') }}" class="form-inline float-right">
                    <input name="name" class="form-control mr-sm-2" type="search" placeholder="搜尋..."
                           aria-label="搜尋...">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">送出搜尋</button>
                </form>
            </div>
        </div>
    </div>

    <div class="row main-padding">
        <div class="col-12">
            <table class="table table-striped bg-white">
                <thead>
                <tr>
                    <th scope="col">班級</th>
                    <th scope="col">人數</th>
                    <th scope="col">學生資料</th>
                    <th scope="col">已指派的考卷</th>
                    <th scope="col">移除班級</th>
                </tr>
                </thead>
                <tbody>
                <!--tr>
                    <td>五年丁班</td>
                    <td>29</td>
                    <td><a href="{{ url('exams/start') }}">檢視</a></td>
                    <td><a href="{{ url('exams/start') }}">檢視</a></td>
                    <td>
                        <button type="button" class="btn btn-warning btn-sm delete" data-toggle="modal"
                                data-target="#deleteModal" data-keyword="班級" data-url="{{ url('classrooms/1') }}">刪除
                        </button>
                    </td>
                </tr-->
                @foreach($classroom_selects as $classroom)
                    <tr>
                        <td>{{ $classroom->fullName() }}</td>
                        <td>{{ count($classroom->students) }}</td>
                        <td><a href="{{ url('classrooms/teacher-detail-view/'.$classroom->id) }}">檢視</a></td>
                        <td><a href="#" data-toggle="modal" data-target="#examModal">檢視</a></td>
                        <td>
						<button type="button" class="btn btn-warning btn-sm delete" data-toggle="modal"
                                data-target="#deleteModal" data-keyword="班級" data-url="{{ url('classrooms/1') }}">刪除
                        </button>
						</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">欲新增班級</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<form action="{{ url('users/add-class') }}" method="post">
			@csrf
                <div class="modal-body">
                    <select name="subject_classroom_id" class="form-control">
                        @foreach($classrooms as $classroom)
                            <option value="{{ $classroom->id }}">{{ $classroom->fullName() }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary">確認</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">取消</button>
                </div>
				</form>
            </div>
			
        </div>
    </div>
	<!-- Modal -->
    <div class="modal fade" id="examModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">已指派考卷</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<form action="{{ url('users/add-class') }}" method="post">
			@csrf
                <div class="modal-body">
                    班級：五年丁班<br>
					・考卷名稱<br>
・考卷名稱考卷名稱考卷名稱<br>
・考卷名稱考卷名稱<br>
					<!--select name="subject_classroom_id" class="form-control">
                        @foreach($classrooms as $classroom)
                            <option value="{{ $classroom->id }}">{{ $classroom->fullName() }}</option>
                        @endforeach
                    </select-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-r" data-dismiss="modal">關閉</button>
                </div>
				</form>
            </div>
			
        </div>
    </div>
@endsection
@section('script')
    <script>

    </script>
@endsection
