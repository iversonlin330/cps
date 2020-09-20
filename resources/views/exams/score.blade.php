@extends('layouts.master')
@section('title1', '班級學習成績')
@section('title2', '主頁 / 作答及成績 / 班級學習成績')
@section('content')
 <div class="row-fluid main-padding">
	<div class="float-right">
		<form class="form-inline float-right">
		<select class="form-control mr-sm-2">
		<option>109/01/01~10912/31</option>
		</select>
		<select class="form-control mr-sm-2">
		<option>縣市</option>
		</select>
		<select class="form-control mr-sm-2">
		<option>學校</option>
		</select>
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
      <th scope="col">考試學校</th>
	  <th scope="col">考試班級</th>
      <th scope="col">班平均分</th>
      <th scope="col">滿分</th>
	  <th scope="col">班各項指標</th>
	  <th scope="col">學生分數</th>
	  <th scope="col">資料匯出</th>
    </tr>
  </thead>
  <tbody>
  @for($i=0;$i<=5;$i++)
    <tr>
      <td>考卷名稱ＯＯＯＯＯ</td>
      <td>單元Ａ/單元B/單元C</td>
	  <td>新北市立新埔國小</td>
	  <td>三年甲班</td>
      <td>22</td>
      <td>30</td>
	  <td><a href="#" data-toggle="modal" data-target="#exampleModal">檢視</a></td>
	  <td><a href="#" data-toggle="modal" data-target="#exampleModal">檢視</a></td>
	  <td><button type="button" class="btn btn-warning btn-sm">匯出</button></td>
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
