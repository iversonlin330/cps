@extends('layouts.master')
@section('title1', '新增教師資料')
@section('title2', '資料設定 / 教師資料設定 / 新增教師資料')
@section('content')
 <div class="row-fluid main-padding">
	<div class="row" style="padding-top:24px">
			<div class="col-12">
				<div class="d-flex justify-content-center">
					<div class="login-title " style="width:540px;">
						<p class="-Login text-center">新增教師資料</p>
					</div>
				</div>
				<div class="d-flex justify-content-center">
					<div class="login-content" style="width:540px;height:501px;">
						<form action="{{ url('login') }}" method="post">
							@csrf
							
							<div class="form-group row">
								<label for="inputEmail3" class="col-3 col-form-label">姓名</label>
								<div class="col-9">
								  <input type="email" class="form-control" id="inputEmail3">
								</div>
							  </div>
							
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
								<label for="inputEmail3" class="col-3 col-form-label">性別</label>
								<div class="col-9">
								  <div class="form-check form-check-inline">
									  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
									  <label class="form-check-label" for="inlineRadio1">男</label>
									</div>
									<div class="form-check form-check-inline">
									  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
									  <label class="form-check-label" for="inlineRadio2">女</label>
									</div>
								</div>
							  </div>
							  
							  <div class="form-group row">
								<label for="inputEmail3" class="col-3 col-form-label">帳號</label>
								<div class="col-9">
								  <input type="email" class="form-control" id="inputEmail3">
								</div>
							  </div>
							  
							  <div class="form-group row">
								<label for="inputEmail3" class="col-3 col-form-label">密碼</label>
								<div class="col-9">
								  <input type="email" class="form-control" id="inputEmail3">
								</div>
							  </div>
							  
							  <div class="form-group row">
								<label for="inputEmail3" class="col-3 col-form-label">電子信箱</label>
								<div class="col-9">
								  <input type="email" class="form-control" id="inputEmail3">
								</div>
							  </div>
							  
							  <div class="form-group row">
								<label for="inputEmail3" class="col-3 col-form-label">教師編號</label>
								<div class="col-9">
								  <input type="email" class="form-control" id="inputEmail3">
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
