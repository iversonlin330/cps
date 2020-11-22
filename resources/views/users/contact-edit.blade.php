@extends('layouts.master')
@section('title1', '個人資料設定')
@section('title2', '資料設定 / 個人資料設定')
@section('content')
    <div class="row-fluid main-padding">
        <div class="row" style="padding-top:24px">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <div class="login-title " style="width:540px;">
                        <p class="-Login text-center">個人資料設定</p>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="login-content" style="width:540px;">
                        <form action="{{ isset($user)? url('users/'.$user->id) : url('users') }}" method="post">
                            @if(isset($user))
                                @method('PUT')
                            @endif
                            @csrf

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-3 col-form-label">修改密碼</label>
                                <div class="col-9">
                                    <input name="password" type="password" class="form-control" id="inputEmail3">
                                </div>
                            </div>
							
							<div class="form-group row">
                                <label for="inputEmail3" class="col-3 col-form-label">確認密碼</label>
                                <div class="col-9">
                                    <input type="password" class="form-control" id="inputEmail3" value="{{ $user->password}}">
                                </div>
                            </div>
@if($user->role == 2)
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-3 col-form-label">電子信箱</label>
                                <div class="col-9">
                                    <input name="email" type="email" class="form-control" value="{{ $user->email}}">
                                </div>
                            </div>
						@endif
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
