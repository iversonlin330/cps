@extends('layouts.master')
@section('title1', '班級學習成績')
@section('title2', '主頁 / 作答及成績 / 班級學習成績')
@section('content')
    <div class="row main-padding mb-2">
        <div class="col-12">
            <div class="float-right">
                <form class="form-inline float-right">
                    <select class="form-control mr-sm-2">
                        <option>109/01/01~10912/31</option>
                    </select>
                    <select class="form-control mr-sm-2">
                        <option>縣市</option>
                    </select>
                    <select class="form-control mr-sm-2">
                        <option>學校</option>
                    </select>
                    <input class="form-control mr-sm-2" type="search" placeholder="搜尋..." aria-label="搜尋...">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">送出搜尋</button>
                </form>
            </div>
        </div>
    </div>

    <div class="row main-padding">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">考卷名稱</th>
                    <th scope="col">組合單元</th>
                    <th scope="col">考試學校</th>
                    <th scope="col">考試班級</th>
                    <th scope="col">班平均分</th>
                    <th scope="col">滿分</th>
                    <th scope="col">班各項指標</th>
                    <th scope="col">學生分數</th>
                    <th scope="col">資料匯出</th>
                </tr>
                </thead>
                <tbody>
                @for($i=0;$i<=5;$i++)
                    <tr>
                        <td>考卷名稱ＯＯＯＯＯ</td>
                        <td>單元Ａ/單元B/單元C</td>
                        <td>新北市立新埔國小</td>
                        <td>三年甲班</td>
                        <td>22</td>
                        <td>30</td>
                        <td><a href="#" data-toggle="modal" data-target="#viewModal">檢視</a></td>
                        <td><a href="{{ url('exams/score-detail') }}">檢視</a></td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm">匯出</button>
                        </td>
                    </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">班各項指標分數</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">指標</th>
                            <th scope="col">學生分數</th>
                            <th scope="col">過往平均</th>
                            <th scope="col">滿分</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($targets as $k=>$v)
                            <tr>
                                <td>{{ $v }}</td>
                                <td>3</td>
                                <td>4</td>
                                <td>5</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-r" data-dismiss="modal">關閉</button>
                </div>
            </div>
        </div>
    </div>
@endsection
