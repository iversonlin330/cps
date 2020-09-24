@extends('layouts.master')
@section('title1', '新增考卷')
@section('title2', '主頁 / 我的考卷 / 新增考卷')
@section('content')
 <div class="row-fluid main-padding">
 <form action="{{ url('exams') }}" method="post">
 @csrf
	<div class="row" style="padding-top:24px">
		<div class="col-12">
			<div>1. 輸入考卷名稱</div>
			<div class="col-3">
				<input type="email" class="form-control" id="inputEmail3" placeholder="考卷名稱">
			</div>
			<div>2. 選取欲組合單元</div>
			</div>
	</div>
		<div class="row" style="padding-top:24px">
			<div class="col-4">
				<div class="d-flex justify-content-center">
					<div class="login-title " style="width:390px;">
						<p class="-Login text-center">公開單元</p>
					</div>
				</div>
				<div class="d-flex justify-content-center bg-white table-scroll">
					<table class="table table-striped">
					  <thead>
						<tr>
						  <th scope="col">預覽</th>
						  <th scope="col">單元名稱</th>
						</tr>
					  </thead>
					  <tbody>
					  @for($i=0;$i<=500;$i++)
						<tr>
						  <td>檢視</td>
						  <td>單元名稱ＯＯＯＯＯ</td>
						</tr>
						@endfor
					  </tbody>
					</table>
				</div>
				<div class="d-flex justify-content-center">
					<div class="login-buttom"></div>
				</div>
			</div>
			<div class="col-4">
				<div class="d-flex justify-content-center">
					<div class="login-title " style="width:390px;">
						<p class="-Login text-center">我的單元</p>
					</div>
				</div>
				<div class="d-flex justify-content-center bg-white table-scroll">
					<table class="table table-striped">
					  <thead>
						<tr>
						  <th scope="col">預覽</th>
						  <th scope="col">單元名稱</th>
						</tr>
					  </thead>
					  <tbody>
					  @for($i=0;$i<=500;$i++)
						<tr>
						  <td>檢視</td>
						  <td>單元名稱ＯＯＯＯＯ</td>
						</tr>
						@endfor
					  </tbody>
					</table>
				</div>
				<div class="d-flex justify-content-center">
					<div class="login-buttom"></div>
				</div>
			</div>
			<div class="col-4">
				<div class="d-flex justify-content-center">
					<div class="login-title " style="width:390px; background-color: #f5c323;">
						<p class="-Login text-center">已選取考券</p>
					</div>
				</div>
				<div class="d-flex justify-content-center bg-white table-scroll">
					<table class="table table-striped">
					  <thead>
						<tr>
						  <th scope="col">單元名稱</th>
						   <th scope="col"></th>
						</tr>
					  </thead>
					  <tbody>
					  @for($i=0;$i<=500;$i++)
						<tr>
						  <td>單元名稱ＯＯＯＯＯ</td>
						  <td>X</td>
						</tr>
						@endfor
					  </tbody>
					</table>
				</div>
				<div class="d-flex justify-content-center">
					<div class="login-buttom" style="background-color: #f5c323;"></div>
				</div>
			</div>
		</div>
		<div class="d-flex justify-content-center">
			<input type="submit" class="btn btn-r" style="width: 83px;margin-top:20px;" value="下一步">
		</div>
		</form>
</div>
@endsection
