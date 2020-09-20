@extends('layouts.master')
@section('title1', '所有考卷')
@section('title2', '主頁 / 考卷專區 / 所有考卷')
@section('content')
 <div class="row-fluid main-padding">
	<div class="float-left">
		<button type="button" class="btn btn-warning">新增考券</button>
	</div>
	<div class="float-right">
		<form class="form-inline float-right">
			<input class="form-control mr-sm-2" type="search" placeholder="搜尋..." aria-label="搜尋...">
			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">送出搜尋</button>
	  </form>
	</div>
</div>

 <div class="row-fluid main-padding">
	<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">考卷名稱</th>
      <th scope="col">組合單元</th>
      <th scope="col">平均分</th>
      <th scope="col">滿分</th>
	  <th scope="col">各項指標</th>
	  <th scope="col">測驗</th>
	  <th scope="col">指派考卷</th>
	  <th scope="col">動作</th>
	  <th scope="col">刪除考卷</th>
    </tr>
  </thead>
  <tbody>
  @for($i=0;$i<=5;$i++)
    <tr>
      <td>考卷名稱ＯＯＯＯＯ</td>
      <td>單元Ａ/單元B/單元C</td>
      <td>22</td>
      <td>30</td>
	  <td>檢視</td>
	  <td><button type="button" class="btn btn-warning btn-sm">作答</button></td>
	  <td><button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal">指派考券</button></td>
	  <td>
		<button type="button" class="btn btn-warning btn-sm">複製</button>
		<button type="button" class="btn btn-warning btn-sm">編輯</button>
	  </td>
	  <td><button type="button" class="btn btn-warning btn-sm">刪除</button></td>
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
        <h5 class="modal-title" id="exampleModalLabel">指派考券</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
		  <thead class="thead-dark">
			<tr>
			  <th scope="col">班級</th>
			  <th scope="col">選取</th>
			</tr>
		  </thead>
		  <tbody>
		  @for($i=0;$i<=305;$i++)
			<tr>
			  <td>一年甲班</td>
			  <td><input type="checkbox"></td>
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
