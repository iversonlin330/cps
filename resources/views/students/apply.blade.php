@extends('layouts.master')
@section('title1', '申請學生帳號')
@section('title2', '資料設定 / 班級資料設定 / 申請學生帳號')
@section('content')
    <div class="row-fluid main-padding">
        <div class="row" style="padding-top:24px">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <div class="login-title " style="width:540px;">
                        <p class="-Login text-center">申請學生帳號 </p>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="login-content" style="width:540px;">
                        <form action="{{ url('students/apply') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-3 col-form-label">資料筆數</label>
                                <div class="col-9">
                                    <input name="number" type="number" class="form-control" id="inputEmail3" required>
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

    </script>
@endsection
