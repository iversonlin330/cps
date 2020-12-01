@extends('layouts.master')
@section('title1', '班級資料設定')
@section('title2', '資料設定 / 班級資料設定 / 學生資料')
@section('content')
    <div class="row main-padding mb-2">
        <div class="col-12">
            <div class="float-left">
			<a href="{{ url('classrooms/teacher-view') }}">返回</a>
            </div>
            <div class="float-right">
			<a href="{{ url('classrooms/export/'.$classroom->id) }}" class="btn btn-warning">資料匯出</a>
            </div>
        </div>
    </div>

    <div class="row main-padding">
        <div class="col-12">
            <table class="table table-striped bg-white">
                <thead>
                <tr>
                    <th scope="col">班級</th>
                    <th scope="col">座號</th>
                    <th scope="col">姓名</th>
                </tr>
                </thead>
                <tbody>
                @foreach($classroom->students as $student)
                    <tr>
                        <td>{{ $classroom->fullName() }}</td>
                        <td>{{ $student->seat_number }}</td>
						<td>{{ $student->name }}</td>
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
