@extends('layouts.master')
@section('title1', '新增多筆學生資料')
@section('title2', '資料設定 / 學生資料設定 / 新增多筆學生資料')
@section('content')
 <div class="row-fluid main-padding">
	<div class="row" style="padding-top:24px">
			<div class="col-12">
				<div class="d-flex justify-content-center">
					<div class="login-title " style="width:540px;">
						<p class="-Login text-center">新增多筆學生資料</p>
					</div>
				</div>
				<div class="d-flex justify-content-center">
					<div class="login-content" style="width:540px;">
						<form action="{{ url('students/create-multi') }}" method="post">
							@csrf
							<div class="form-group row">
								<label for="inputEmail3" class="col-3 col-form-label">學校</label>
								<div class="col-4">
								  <select class="form-control">
									<option>新北市</option>
								  </select>
								</div>
								<div class="col-5">
								  <select class="form-control">
									<option>文德國小</option>
								  </select>
								</div>
							  </div>

							<div class="form-group row">
								<label for="inputEmail3" class="col-3 col-form-label">資料筆數</label>
								<div class="col-9">
								  <input type="number" class="form-control" id="inputEmail3">
								</div>
							  </div>

							<div class="d-flex justify-content-center">
								<input type="submit" class="btn btn-r" style="width: 83px;" value="儲存">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
</div>
@endsection
