@extends('layouts.master')
@section('title1', '作答結果')
@section('title2', '首頁 / 我的任務 / 任務作答 / 作答結果')
@section('content')
 <div class="row-fluid main-padding">
	<div class="row" style="padding-top:24px">
		<div class="col-12">
			<div class="d-flex justify-content-center exam-title bg-squash">
					<p class="-Login text-center mt-2">作答結果<br>{{ $task->name }}</p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="d-flex justify-content-center bg-white">
					<p class="text-center mt-2 text-brown">測驗完成！
<br>您的總指標分數：{{ $person_score }} 分<br><span style="color: #3f3f3f;">學生過往平均指標分數：0 分<span></p>
			</div>
			<div class="d-flex justify-content-center bg-white m-auto">
				<table class="table table-striped" style="max-width:500px">
				  <thead class="thead-light">
					<tr>
					  <th scope="col">指標</th>
					   <th scope="col">您的分數</th>
					   <th scope="col">過往平均</th>
					   <th scope="col">滿分</th>
					</tr>
				  </thead>
				  <tbody>
                  @foreach($targets as $k=>$v)
                      <tr>
                          <td>{{ $v }}</td>
                          <td>{{ $result[$k] }}</td>
                          <td>0</td>
                          <td>{{ $total[$k] }}</td>
                      </tr>
                  @endforeach
				  </tbody>
				</table>
			</div>
			<div class="d-flex justify-content-center bg-white pb-4">
			<a href="{{ url('tasks?unit_id='.$task->unit_id) }}" class="btn btn-r" style="width: 83px;margin-top:20px;">回列表</a>
		</div>
		</div>
	</div>
</div>
@endsection
