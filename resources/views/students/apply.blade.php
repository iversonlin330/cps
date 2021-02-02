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
                    您已成功向管理員申請學生帳號，待幾個工作天後，管理員將會為您核准處理
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-r" data-dismiss="modal">關閉</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
	@if($errors->any())
	$("#exampleModal").modal('show');
@endif
    </script>
@endsection
