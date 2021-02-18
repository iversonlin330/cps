@extends('layouts.master')
@php
    $text = Request::is('*edit*')? '修改' : '新增';
@endphp
@section('title1', $text.'單筆學生資料')
@section('title2', '資料設定 / 學生資料設定 / '.$text.'學生單筆資料')
@section('content')
    <div class="row-fluid main-padding">
        <div class="row" style="padding-top:24px">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <div class="login-title " style="width:540px;">
                        <p class="-Login text-center">{{ $text }}單筆學生資料</p>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="login-content" style="width:540px;">
                        <form action="{{ isset($user)? url('students/'.$user->id) : url('students') }}" method="post">
                            @if(isset($user))
                                @method('PUT')
                            @endif
                            @csrf
                            <input type="text" name="role" class="form-control" value="3" hidden>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-3 col-form-label">學校</label>
                                <div class="col-4">
                                    <select name="city_id" class="form-control" {{ ($text == '修改')? 'disabled' : '' }}>
                                        @foreach($citys as $city => $school)
                                            <option value="{{ $city }}">{{ $city }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-5">
                                    <select name="school_id"
                                            class="form-control" {{ ($text == '修改')? 'disabled' : '' }}>
                                        <option>文德國小</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-3 col-form-label">班級</label>
                                <div class="col-9">
                                    <select name="classroom_id" class="form-control">
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-3 col-form-label">座號</label>
                                <div class="col-9">
                                    <input type="number" name="seat_number" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-3 col-form-label">姓名</label>
                                <div class="col-9">
                                    <input type="text" name="name" class="form-control" id="inputEmail3">
                                </div>
                            </div>

                        <!--div class="form-group row">
                                <label for="inputEmail3" class="col-3 col-form-label">帳號</label>
                                <div class="col-9">
                                    <input type="text" name="account" class="form-control" id="inputEmail3" {{ ($text == '修改')? 'disabled' : '' }}>
                                </div>
                            </div-->

                            @if(isset($user))
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-3 col-form-label">密碼</label>
                                    <div class="col-9">
                                        <input type="password" name="password" class="form-control" id="inputEmail3">
                                    </div>
                                </div>
                            @endif

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-3 col-form-label">性別</label>
                                <div class="col-9">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender"
                                               id="inlineRadio1" value="1">
                                        <label class="form-check-label" for="inlineRadio1">男</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender"
                                               id="inlineRadio2" value="2">
                                        <label class="form-check-label" for="inlineRadio2">女</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-3 col-form-label">原住民身份</label>
                                <div class="col-9">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_local" value="1">
                                        <label class="form-check-label">是</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_local" value="0">
                                        <label class="form-check-label">否</label>
                                    </div>
                                </div>
                            </div>

                            <!--div class="form-group row">
                                <label for="inputEmail3" class="col-3 col-form-label">帳號</label>
                                <div class="col-9">
                                    <input type="text" name="account" class="form-control" id="inputEmail3">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-3 col-form-label">密碼</label>
                                <div class="col-9">
                                    <input type="password" name="password" class="form-control" id="inputEmail3">
                                </div>
                            </div-->

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
            $("[name='school_id']").trigger('change');
        });
        $("[name='city_id']").trigger('change');

        var classroom_map = @json($classroom_map);

        $("[name='school_id']").change(function () {
            var school_val = $(this).val();
            $("[name='classroom_id']").empty();
            var html = '';
            for (x in classroom_map[school_val]) {
                let fullName = classroom_map[school_val][x]['grade'] + "年" + classroom_map[school_val][x]['class'] + "班";
                html = html + "<option value='" + classroom_map[school_val][x]['id'] + "'>" + fullName + "</option>";
            }
            $("[name='classroom_id']").append(html);
        });
        $("[name='school_id']").trigger('change');


        @if(isset($user))
        let user = @json($user);
        for (const [key, value] of Object.entries(user)) {
            if (key == 'gender' || key == 'is_local') {
                continue;
            }
            $("[name='" + key + "']").val(value);
        }
        $("[name='city_id']").trigger('change');
        $("[name='school_id']").val(user['school_id']);
        $("[name='gender']").filter('[value=' + user.gender + ']').prop('checked', true);
        $("[name='is_local']").filter('[value=' + user.is_local + ']').prop('checked', true);
        @endif
    </script>
@endsection
