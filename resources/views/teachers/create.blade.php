@extends('layouts.master')
@section('title1', '新增教師資料')
@section('title2', '資料設定 / 教師資料設定 / 新增教師資料')
@section('content')
    <div class="row-fluid main-padding">
        <div class="row" style="padding-top:24px">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <div class="login-title " style="width:540px;">
                        <p class="-Login text-center">{{ isset($user)? '修改' : '新增' }}教師資料</p>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="login-content" style="width:540px;height:501px;">
                        <form action="{{ isset($user)? url('teachers/'.$user->id) : url('teachers') }}" method="post">
                            @if(isset($user))
                                @method('PUT')
                            @endif
                            @csrf
                            <input name="role" type="text" value="4" hidden>
                            <input name="is_verify" type="text" value="1" hidden>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">姓名</label>
                                <div class="col-9">
                                    <input name="name" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-3 col-form-label">學校</label>
                                <div class="col-4">
                                    <select name="city_id" class="form-control" required>
                                        @foreach($citys as $city => $school)
                                            <option value="{{ $city }}">{{ $city }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-5">
                                    <select name="school_id" class="form-control" required>
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
@endsection
@section('script')
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
@endsection
