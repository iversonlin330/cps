<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
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
		<div class="row">
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
								<label for="exampleFormControlInput1">帳號</label>
								<input type="email" class="form-control" id="exampleFormControlInput1" placeholder="請輸入帳號">
							  </div>
							<input type="text" name="account">
							<input type="text" name="role" value="1">
							<input type="submit" value="submit">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
    
    </body>
</html>
