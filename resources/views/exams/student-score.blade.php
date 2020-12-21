@extends('layouts.master')
@section('title1', '班級學習成績')
@section('title2', '主頁 / 作答及成績 / 班級學習成績')
@section('content')
    <div class="row main-padding mb-2">
        <div class="col-12">
            <div class="float-right">
                <form action="{{ url('exams/student-score') }}" class="form-inline float-right">
                    <!--select class="form-control mr-sm-2">
                        <option>109/01/01~10912/31</option>
                    </select>
                    <select class="form-control mr-sm-2">
                        <option>縣市</option>
                    </select>
                    <select class="form-control mr-sm-2">
                        <option>學校</option>
                    </select-->
                    <input name="name" class="form-control mr-sm-2" type="search" placeholder="搜尋..."
                           aria-label="搜尋...">
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
                    <th scope="col">我的分數</th>
                    <th scope="col">班平均分</th>
                    <th scope="col">滿分</th>
                    <th scope="col">各項指標</th>
                </tr>
                </thead>
                <tbody>
                @foreach($exams as $exam)
                    @if($data)
                        @if(strpos($data['name'], $exam->name !== false))
                            @continue
                        @endif
                    @endif
                    <tr>
                        <td>{{ $exam->name }}</td>
                        <td>{{ implode('/',$exam->units()->pluck('name')->toArray()) }}</td>
                        <td>{{ array_sum($exam->my_score()) }}</td>
                        <td>{{ array_sum($exam->avg_score()) }}</td>
                        <td>{{ array_sum($exam->total_score()) }}</td>
                        <td><a href="#" class="target" data-toggle="modal" data-target="#target_modal"
                               data-my="{{ json_encode($exam->my_score()) }}"
                               data-total="{{ json_encode($exam->total_score()) }}"
                               data-avg="{{ json_encode($exam->avg_score()) }}">檢視</a></td>
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
