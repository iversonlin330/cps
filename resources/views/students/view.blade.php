@extends('layouts.master')
@section('title1', '學生資料設定')
@section('title2', '資料設定 / 學生資料設定')
@section('content')
 <div class="row-fluid main-padding">
	<div class="float-left">
		<a href="{{ url('students/create') }}" class="btn btn-warning">新增學生</a>
	</div>
	<div class="float-right">
		<form class="form-inline float-right">
		<select class="form-control mr-sm-2">
		<option>109/01/01~109/12/31</option>
		</select>
		<select class="form-control mr-sm-2">
		<option>縣市</option>
		</select>
		<select class="form-control mr-sm-2">
		<option>學校</option>
		</select>
			<input class="form-control mr-sm-2" type="search" placeholder="搜尋..." aria-label="搜尋...">
			<button class="btn btn-secondary my-2 my-sm-0" type="submit">送出搜尋</button>
	  </form>
	</div>
</div>

 <div class="row-fluid main-padding">
	<table class="table table-striped">
  <thead>
    <tr>
	<th scope="col">學年度</th>
      <th scope="col">學校</th>
	<th scope="col">班級</th>
	<th scope="col">編號</th>
	<th scope="col">姓名</th>
	  <th scope="col">性別</th>
      <th scope="col">帳號</th>
      <th scope="col">密碼</th>
	  <th scope="col">動作</th>
    </tr>
  </thead>
  <tbody>
  @for($i=0;$i<=5;$i++)
    <tr>
<td>109</td>
      <td>新北市立文德國民小學</td>
	   <td>五年丁班</td>
	   <td>000001</td>
	  <td>黃小玲</td>
	  <td>女</td>
      <td>000001</td>
      <td>000001</td>
	  <td>
		<button type="button" class="btn btn-warning btn-sm">編輯</button>
	  <button type="button" class="btn btn-warning btn-sm">刪除</button>
	  </td>
    </tr>
	@endfor
  </tbody>
</table>
</div>
        
	<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">各項指標分數</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
		  <thead class="thead-light">
			<tr>
			  <th scope="col">指標</th>
			  <th scope="col">過往平均</th>
			  <th scope="col">滿分</th>
			</tr>
		  </thead>
		  <tbody>
		  @for($i=0;$i<=305;$i++)
			<tr>
			  <td>A1發現團隊成員的觀點與能力</td>
			  <td>3</td>
			 <td>5</td> 
			</tr>
			@endfor
		  </tbody>
		</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">確認</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">取消</button>
      </div>
    </div>
  </div>
</div>
@endsection
