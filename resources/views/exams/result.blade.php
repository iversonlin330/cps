@extends('layouts.master')
@section('title1', '作答結果')
@section('title2', '首頁 / 我的考卷 / 考卷作答 / 作答結果')
@section('content')
 <div class="row-fluid main-padding">
	<div class="row" style="padding-top:24px">
		<div class="col-12">
			<div class="d-flex justify-content-center exam-title bg-brown">
					<p class="-Login text-center mt-2">作答結果<br>考卷名稱ＯＯＯＯＯＯＯＯ</p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="d-flex justify-content-center bg-white">
					<p class="text-center mt-2 text-brown">測驗完成！
<br>您的總指標分數：25 分<br><span style="color: #3f3f3f;">學生過往平均指標分數：21 分<span></p>
			</div>
			<div class="d-flex justify-content-center bg-white m-auto">
				<table class="table table-striped" style="max-width:500px">
				  <thead class="thead-light">
					<tr>
					  <th scope="col">指標</th>
					   <th scope="col">您的分數</th>
					   <th scope="col">過往平均</th>
					</tr>
				  </thead>
				  <tbody>
				  @for($i=0;$i<=12;$i++)
					<tr>
					  <td>A1發現團隊成員的觀點與能力</td>
					  <td>3</td>
					  <td>3</td>
					</tr>
					@endfor
				  </tbody>
				</table>
			</div>
			<div class="d-flex justify-content-center bg-white pb-4">
			<input type="submit" class="btn btn-r" style="width: 83px;margin-top:20px;" value="回列表">
		</div>
		</div>
	</div>
</div>
@endsection
