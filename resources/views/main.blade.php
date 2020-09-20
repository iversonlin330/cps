@extends('layouts.master')
@section('title1', 'CPS評量系統')
@section('title2', '主頁')
@section('content')
    <div class="row main-padding" style="">
        <div class="col-12">
            <!--div style="font-size: 22px;margin-top:40px;">CPS評量系統</div>
            <div>主頁</div>
            <hr/-->
            <div class="row main-block">
				<div class="col-12">
					<div>考券專區</div>
				</div>
				<div class="col-4 main-block-sub d-flex align-items-center">
					<div class="main-block-sub-icon bg-brown text-white d-inline-flex"></div>
					<div class="d-inline-flex">我的考券</div>
				</div>
				<div class="col-4 main-block-sub d-flex align-items-center" onclick="location.href='{{url('exams') }}'">
					<div class="main-block-sub-icon bg-brown text-white d-inline-flex"></div>
					<div class="d-inline-flex">所有考券</div>
				</div>
            </div>
			<div class="row main-block">
				<div class="col-12">
					<div>單元專區</div>
				</div>
				<div class="col-4 main-block-sub d-flex align-items-center">
					<div class="main-block-sub-icon bg-squash text-white d-inline-flex"></div>
					<div class="d-inline-flex">我的單元</div>
				</div>
				<div class="col-4 main-block-sub d-flex align-items-center">
					<div class="main-block-sub-icon bg-squash text-white d-inline-flex"></div>
					<div class="d-inline-flex">所有單元</div>
				</div>
				<div class="col-4 main-block-sub d-flex align-items-center">
					<div class="main-block-sub-icon bg-squash text-white d-inline-flex"></div>
					<div class="d-inline-flex">審核單元</div>
				</div>
            </div>
			<div class="row main-block">
				<div class="col-12">
					<div>作答記錄及成績</div>
				</div>
				<div class="col-4 main-block-sub d-flex align-items-center">
					<div class="main-block-sub-icon bg-blue text-white d-inline-flex"></div>
					<div class="d-inline-flex">班級學習成績</div>
				</div>
				<div class="col-4 main-block-sub d-flex align-items-center">
					<div class="main-block-sub-icon bg-blue text-white d-inline-flex"></div>
					<div class="d-inline-flex">單元學習成績</div>
				</div>
            </div>
			<div class="row main-block">
				<div class="col-12">
					<div>資料設定</div>
				</div>
				<div class="col-4 main-block-sub d-flex align-items-center">
					<div class="main-block-sub-icon bg-grey text-white d-inline-flex">
						<i class="fal fa-user fa-lg icon"></i>
					</div>
					<div class="d-inline-flex">學生資料設定</div>
				</div>
				<div class="col-4 main-block-sub d-flex align-items-center">
					<div class="main-block-sub-icon bg-grey text-white d-inline-flex">
						<i class="fal fa-users fa-lg icon"></i>
					</div>
					<div class="d-inline-flex">教師資料設定</div>
				</div>
				<div class="col-4 main-block-sub d-flex align-items-center">
					<div class="main-block-sub-icon bg-grey text-white d-inline-flex">
						<i class="fal fa-school fa-lg icon"></i>
					</div>
					<div class="d-inline-flex">學校窗口資料</div>
				</div>
				<div class="col-4 main-block-sub d-flex align-items-center" data-toggle="modal" data-target="#exampleModal">
					<div class="main-block-sub-icon bg-scarlet text-white d-inline-flex">
						<i class="fal fa-exclamation-circle fa-lg icon"></i>
					</div>
					<div class="d-inline-flex">年度資料封存</div>
				</div>
            </div>
        </div>
    </div>
	<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">年度資料封存</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        封存學生資料前請注意以下事項：<br>
1.封存前務必發訊息通知教師與學生。<br>
2.封存後，系統僅提供學生歷史成績查詢，本學期學生帳號將無法繼續使用。<br>
3.務必於每學期結束後執行一次資料封存。上學期資料封存日期：1/25~2/15，下學期資料封存日期：7/15~8/15。
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">確認</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">取消</button>
      </div>
    </div>
  </div>
</div>
@endsection
