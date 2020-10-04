@extends('layouts.master')
@section('title1', '班級資料設定')
@section('title2', '資料設定 / 班級資料設定')
@section('content')
    <div class="row-fluid main-padding">
        <div class="float-left">
            <a class="btn btn-warning" data-toggle="modal" data-target="#addModal">新增班級</a>
        </div>
        <div class="float-right">
            <form action="{{ url('classrooms') }}" class="form-inline float-right">
                <input name="name" class="form-control mr-sm-2" type="search" placeholder="搜尋..." aria-label="搜尋...">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">送出搜尋</button>
            </form>
        </div>
    </div>

    <div class="row-fluid main-padding">
        <table class="table table-striped">
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
			<tr>
				<td>五年丁班</td>
				<td>29</td>
				<td>29</td>
				<td><a href="{{ url('exams/start') }}" >檢視</a></td>
				<td><a href="{{ url('exams/start') }}" >檢視</a></td>
				<td>
					<button type="button" class="btn btn-warning btn-sm delete" data-toggle="modal"
							data-target="#deleteModal" data-keyword="班級" data-url="{{ url('classrooms/1') }}">刪除
					</button>
				</td>
			</tr>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->city . $user->school }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->account }}</td>
                    <td>{{ $user->password }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ url('contacts/'.$user->id.'/edit') }}" class="btn btn-warning btn-sm">編輯</a>
                        <button type="button" class="btn btn-warning btn-sm delete" data-toggle="modal"
                                data-target="#deleteModal" data-keyword="窗口" data-url="{{ url('contacts/'.$user->id) }}">刪除
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
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
