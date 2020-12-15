@extends('layouts.master')
@section('title1', '班級學習成績')
@section('title2', '主頁 / 作答及成績 / 班級學習成績')
@section('content')
    <div class="row main-padding mb-2">
        <div class="col-12">
            <div class="float-left">
                <a href="{{ url('exams/score') }}">返回</a>
            </div>
        </div>
    </div>

    <div class="row main-padding">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">班級</th>
                    <th scope="col">座號</th>
                    <th scope="col">姓名</th>
                    <th scope="col">總分數</th>
                    <th scope="col">各項指標</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user_exams as $user_exam)
                    <tr>
                        <td>{{ $user_exam->user->classroom->fullName() }}</td>
                        <td>{{ $user_exam->user->seat_number }}</td>
                        <td>{{ $user_exam->user->name }}</td>
                        <td>{{ array_sum($user_exam->score_array) }}</td>
                        <td><a href="#" class="target" data-toggle="modal" data-target="#target_modal"
                               data-my="{{ json_encode($user_exam->score_array) }}"
                               data-total="{{ json_encode($exam->total_score()) }}"
                               data-avg="{{ json_encode($exam->avg_class_score($user_exam->user->classroom->id)) }}">檢視</a></td>
                    </tr>
                @endforeach
                @for($i=0;$i<=0;$i++)
                    <tr>
                        <td>三年甲班</td>
                        <td>22</td>
                        <td>XXX</td>
                        <td>50</td>
                        <td><a href="#" data-toggle="modal" data-target="#viewModal">檢視</a></td>
                    </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <!-- Modal -->
    <div class="modal fade" id="target_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">學生各項指標分數</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">指標</th>
                            <th scope="col">個人分數</th>
                            <th scope="col">班平均</th>
                            <th scope="col">滿分</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($targets as $k=>$v)
                            <tr>
                                <td>{{ $v }}</td>
                                <td id="my_{{$k}}">0</td>
                                <td id="avg_{{$k}}">0</td>
                                <td id="total_{{$k}}">0</td>
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
