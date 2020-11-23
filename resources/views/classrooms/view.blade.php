@extends('layouts.master')
@section('title1', '班級資料設定')
@section('title2', '資料設定 / 班級資料設定')
@section('content')
    <div class="row main-padding mb-2">
        <div class="col-12">
            <div class="float-left">
                <a href="{{ url('classrooms/create') }}" class="btn btn-warning">新增班級</a>
				<a href="{{ url('students/apply') }}" class="btn btn-secondary">申請學生帳號</a>
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
					<th scope="col">班級資料</th>
                    <th scope="col">學生資料</th>
                    <th scope="col">所屬教師</th>
                    <th scope="col">刪除班級</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>五年丁班</td>
                    <td>29</td>
                    <td>
						<a href="{{ url('classrooms/create') }}" class="btn btn-secondary btn-sm">編輯</a>
					</td>
                    <td>
						<a href="{{ url('users/contact-students-edit') }}" class="btn btn-secondary btn-sm">編輯</a>
					</td>
					<td>
						林小揚
					</td>
                    <td>
                        <button type="button" class="btn btn-warning btn-sm delete" data-toggle="modal"
                                data-target="#deleteModal" data-keyword="班級" data-url="{{ url('classrooms/1') }}">刪除
                        </button>
                    </td>
                </tr>
                @foreach($classrooms as $classroom)
                    <tr>
                        <td>{{ $classroom->fullName }}</td>
                        <td>{{ $classroom->students->count() }}</td>
                        <td>
                            <a href="{{ url('classrooms/create') }}" class="btn btn-secondary btn-sm">編輯</a>
                        </td>
                        <td>
                            <a href="{{ url('users/contact-students-edit') }}" class="btn btn-secondary btn-sm">編輯</a>
                        </td>
                        <td>{{ $classroom->teacher }}</td>
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
                <div class="modal-body">
                    <select class="form-control">
                        <option>選擇班級</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">確認</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>

    </script>
@endsection
