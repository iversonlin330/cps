@extends('layouts.master')
@section('title1', '個人學習成績')
@section('title2', '主頁 / 作答及成績 / 個人學習成績')
@section('content')
    <div class="row main-padding mb-2">
        <div class="col-12">
            <div class="float-right">
                <form class="form-inline float-right">
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
                    @if($user->role == 1)
                        <th scope="col">訪客編號</th>
                    @endif
                    <th scope="col">單元名稱</th>
                    <th scope="col">我的分數</th>
                    <th scope="col">歷年平均分</th>
                    <th scope="col">滿分</th>
                    <th scope="col">各項指標</th>
                    <th scope="col">作答時間</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user_units as $user_unit)
                    <tr>
                        @if($user->role == 1)
                            <td>{{ $user_unit->id }}</td>
                        @endif
                        <td>{{ $user_unit->unit->name }}</td>
                        <td>{{ array_sum($user_unit->unit->my_score()) }}</td>
                        <td>{{ array_sum($user_unit->unit->avg_score()) }}</td>
                        <td>{{ array_sum($user_unit->unit->total_score()) }}</td>
                        <td>
                            <a href="#" class="target" data-toggle="modal" data-target="#target_modal"
                               data-my="{{ json_encode($user_unit->unit->my_score()) }}"
                               data-avg="{{ json_encode($user_unit->unit->avg_score()) }}"
                               data-total="{{ json_encode($user_unit->unit->total_score()) }}">檢視</a>
                        </td>
                        <td>{{ $user_unit->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="target_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
