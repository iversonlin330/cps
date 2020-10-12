<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

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
								<div>忘記密碼?</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

    </body>
</html>
