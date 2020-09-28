@extends('layouts.master')
@section('title1', '考卷作答')
@section('title2', '首頁 / 我的考卷 / 考卷作答')
@section('content')
 <div class="row-fluid main-padding">
	<div class="row" style="padding-top:24px">
		<div class="col-12">
			<div class="d-flex exam-title bg-brown">
					<div class="mr-auto mt-4 ml-4">
						<p class="-Login">考卷名稱ＯＯＯＯＯＯＯＯ</p>
					</div>
					<div class="mt-2 mr-4">
						<p class="-Login" style="font-size: 40px;">14:39</p>
					</div>
				</div>
		</div>
	</div>
	<div class="row" style="padding-top:24px">
		<div class="col-6 pr-0">
			<div class="pl-4 exam-content bg-brown">
					<div class="row">
						<div class="col-12 mt-4 exam-content-title">題目</div>
					</div>
					<div class="row">
						<div class="col-12 mt-4 exam-content-text">・學校數學課小組報告你是小組長，並且和娃郁、巴
　彥同一組，大家開始討論要怎麼進行半開式窗戶撐
　竿及窗景的調查。
・娃郁：你們知道半開窗是什麼嗎?？
・巴彥：我老家那邊有，可以帶你們去看。 
・娃郁：太好了，不過組長我們要怎麼開始調查呢？
・Q：這時候你會說？</div>
					</div>
					<div class="row">
						<div class="col-12 mt-4 exam-content-title">選項</div>
					</div>
					<div class="row">
						<div class="col-12 mt-4 exam-content-text">大家可以說說看，我們可以用什麼方式了解傳統屋窗戶角度和竹竿的變化呢? 
我也不知道耶，我們去問老師看看？
巴彥家的傳統屋好玩嗎?</div>
					</div>
				</div>
		</div>
		<div class="col-6 pl-0">
			<div class="d-flex justify-content-center exam-img bg-white p-4">
					<img class="m-auto" src="https://images.pexels.com/photos/3009487/pexels-photo-3009487.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940">
				</div>
		</div>
	</div>
		<!--div class="d-flex justify-content-center">
		<input type="submit" class="btn  btn-light" style="width: 83px;margin-top:20px;" value="上一步">
			<input type="submit" class="btn btn-r" style="width: 83px;margin-top:20px;" value="確認">
		</div-->
</div>
@endsection
