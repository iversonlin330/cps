@extends('layouts.master')
@section('title1', '新增班級')
@section('title2', '資料設定 / 班級資料設定 / 新增班級')
@section('content')
    <div class="row-fluid main-padding">
        <form action="{{ url('exams') }}" method="post">
            @csrf
            <div class="row" style="">
                <div class="col-12">
                    <div>1. 輸入班級名稱</div>
					<div class="form-group row">
						<div class="col-1">
							<select name="city_id" class="form-control">
								<option>一</option>
							</select>
						</div>
						<label class="col-form-label">年</label>
						<div class="col-1">
							<input class="form-control" type="number" name="gender" required>
						</div>
						<label class="col-form-label">班</label>
					</div>
					 <div>* 若文字編班，則按順序填數字，如：甲、乙、丙，請填寫1、2、3。</div>
                    <div>2. 選擇該班級學生</div>
                </div>
            </div>
            <div class="row" style="padding-top:24px">
                <div class="col-1">
				</div>
				<div class="col-5">
                    <div class="d-flex justify-content-center">
                        <div class="login-title " style="width:100%;">
                            <p class="-Login text-center">學生資料</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center bg-white table-scroll">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">學生編號</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i=0;$i<=500;$i++)
                                <tr>
                                    <td>10901{{ $i }}</td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="login-buttom" style="width:100%;"></div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="d-flex justify-content-center">
                        <div class="login-title " style="width:100%; background-color: #f5c323;">
                            <p class="-Login text-center">已選取學生</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center bg-white table-scroll">
                        <table id="select_table" class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">學生編號</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i=0;$i<=500;$i++)
                                <tr>
                                    <td>10901{{ $i }}</td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="login-buttom" style="width:100%; background-color: #f5c323;"></div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <input type="submit" class="btn btn-r" style="width: 83px;margin-top:20px;" value="新增">
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        
    </script>
@endsection
