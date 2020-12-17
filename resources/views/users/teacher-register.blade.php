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
					<div class="login-title" style="width: 540px;">
						<p class="-Login text-center">教師帳號註冊</p>
					</div>
				</div>
				<div class="d-flex justify-content-center">
					<div class="login-content" style="width: 540px;">
						<form action="{{ url('users/teacher_register') }}" method="post">
							@csrf
							<input name="role" type="text" value="4" hidden>
							<input name="is_verify" type="text" value="0" hidden>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">姓名</label>
                                <div class="col-9">
                                    <input name="name" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-3 col-form-label">學校</label>
                                <div class="col-4">
                                    <select name="city_id" class="form-control">
                                        @foreach($citys as $city => $school)
                                            <option value="{{ $city }}">{{ $city }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-5">
                                    <select name="school_id" class="form-control">
                                        <option>文德國小</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-3 col-form-label">性別</label>
                                <div class="col-9">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1"
                                               value="1" required>
                                        <label class="form-check-label" for="inlineRadio1">男</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                               value="2">
                                        <label class="form-check-label" for="inlineRadio2">女</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-3 col-form-label">帳號</label>
                                <div class="col-9">
                                    <input name="account" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-3 col-form-label">密碼</label>
                                <div class="col-9">
                                    <input name="password" type="password" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-3 col-form-label">電子信箱</label>
                                <div class="col-9">
                                    <input name="email" type="email" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-3 col-form-label">教師編號</label>
                                <div class="col-9">
                                    <input name="teacherid" type="text" class="form-control" required>
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
	<script>
        var citys = @json($citys);
        $("[name='city_id']").change(function () {
            var city_val = $(this).val();
            $("[name='school_id']").empty();
            var html = '';
            for (x in citys[city_val]) {
                html = html + "<option value='" + x + "'>" + citys[city_val][x] + "</option>";
            }
            $("[name='school_id']").append(html);
        });
        $("[name='city_id']").trigger('change');

            @if(isset($user))
        var user = @json($user);
        for (const [key, value] of Object.entries(user)) {
            if (key == 'gender') {
                continue;
            }
            $("[name='" + key + "']").val(value);
        }
        $("[name='city_id']").trigger('change');
        $("[name='school_id']").val(user['school_id']);
        $("[name='gender']").filter('[value=' + user.gender + ']').prop('checked', true);
        @endif
    </script>

    </body>
</html>

