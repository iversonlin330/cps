@extends('layouts.master')
@section('title1', '新增考卷')
@section('title2', '主頁 / 我的考卷 / 新增考卷')
@section('content')
 <div class="row-fluid main-padding">
	<div class="row" style="padding-top:24px">
		<div class="col-12">
			<div class="d-flex justify-content-center">
					<div class="login-title " style="width:310px; background-color: #f5c323;">
						<p class="-Login text-center">已選取考券</p>
					</div>
				</div>
				<div class="d-flex justify-content-center bg-white table-scroll m-auto" style="width:310px;">
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
					<div class="login-buttom" style="width:310px;background-color: #f5c323;"></div>
				</div>
		</div>
	</div>
		<div class="d-flex justify-content-center">
		<input type="submit" class="btn  btn-light" style="width: 83px;margin-top:20px;" value="上一步">
			<input type="submit" class="btn btn-r" style="width: 83px;margin-top:20px;" value="確認">
		</div>
</div>
@endsection
