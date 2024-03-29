<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CPS評量系統</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <!-- Styles -->
        <style>
        </style>
    </head>
    <body class="bg-color">
	<div class="container-fluid">
		<div class="row banner">
		<div class="col-12 center-block text-center">
			<div class="cps">CPS</div>
			<div class="banner-text">評量系統</div>
			<div class="banner-wellcome">WELLCOME</div>
			</div>
		</div>
		<div class="row" style="padding-top:40px">
			<div class="col-12">
				<div class="d-flex justify-content-center">
					<div class="login-title">
						<p class="-Login text-center">帳號登入 Login</p>
					</div>
				</div>
				<div class="d-flex justify-content-center">
					<div class="login-content">
						<form action="{{ url('login') }}" method="post">
							@csrf
							<div class="form-group">
								<label>帳號</label>
								<input name="account" type="text" class="form-control" placeholder="請輸入帳號">
							  </div>
                            <div class="form-group">
                                <label>密碼</label>
                                <input name="password" type="password" class="form-control" placeholder="請輸入密碼">
							</div>
							<!--div class="form-group">
                                <label>身分</label>
                                <input name="role" type="text" class="form-control" placeholder="請輸入身分99-管理員、50-老師">
							</div-->
							<div class="d-flex justify-content-center">
								<input type="submit" class="btn btn-r" style="width: 83px;" value="登入">
							</div>
							<div class="d-flex justify-content-center">
								<div data-toggle="modal" data-target="#forgetModal">忘記密碼?</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    您的帳號尚未通過審核，或是帳密錯誤，請聯繫管理員或是重新輸入
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-r" data-dismiss="modal">關閉</button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="forgetModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    請聯繫該校窗口進行密碼回朔，或是寄信至管理者信箱 cpslearn21024017959@gmail.com ，將會有專人為您處理
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-r" data-dismiss="modal">關閉</button>
                </div>
            </div>
        </div>
    </div>
	<script>
	@if($errors->any())
	$("#exampleModal").modal('show');
@endif
    </script>
    </body>
</html>
