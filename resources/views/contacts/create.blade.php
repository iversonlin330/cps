@extends('layouts.master')
@section('title1', '學校窗口資料設定')
@section('title2', '資料設定 / 學校窗口資料設定')
@section('content')
    <div class="row-fluid main-padding">
        <div class="row" style="padding-top:24px">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <div class="login-title " style="width:540px;">
                        <p class="-Login text-center">{{ isset($user)? '修改' : '新增' }}學校窗口資料</p>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="login-content" style="width:540px;">
                        <form action="{{ isset($user)? url('contacts/'.$user->id) : url('contacts') }}" method="post">
                            @if(isset($user))
                                @method('PUT')
                            @endif
                            @csrf
                            <input name="role" type="text" value="2" hidden>
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
                                        <option value="文德國小">文德國小</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-3 col-form-label">姓名</label>
                                <div class="col-9">
                                    <input name="name" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-3 col-form-label">帳號</label>
                                <div class="col-9">
                                    <input name="account" type="text" class="form-control" id="inputEmail3">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-3 col-form-label">密碼</label>
                                <div class="col-9">
                                    <input name="password" type="password" class="form-control" id="inputEmail3">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-3 col-form-label">電子信箱</label>
                                <div class="col-9">
                                    <input name="email" type="email" class="form-control" id="inputEmail3">
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
        let citys = @json($citys);
        $("[name='city_id']").change(function () {
            let city_val = $(this).val();
            $("[name='school_id']").empty();
            let html = '';
            for (x in citys[city_val]) {
                html = html + "<option value='" + citys[city_val][x] + "'>" + citys[city_val][x] + "</option>";
            }
            $("[name='school_id']").append(html);
        });
        $("[name='city_id']").trigger('change');
            @if(isset($user))
        let user = @json($user);
        for (const [key, value] of Object.entries(user)) {
            $("[name='" + key + "']").val(value);
        }
        $("[name='city_id']").trigger('change');
        $("[name='school_id']").val(user['school_id']);
        @endif
    </script>
@endsection
