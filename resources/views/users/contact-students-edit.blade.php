@extends('layouts.master')
@section('title1', '編輯學生資料')
@section('title2', '資料設定 / 班級資料設定 / 編輯學生資料')
@section('content')
    <div class="row main-padding mb-2">
        <div class="col-12">
            <div class="float-right">
                <form class="form-inline float-right">
                    <input class="form-control mr-sm-2" type="search" placeholder="搜尋..." aria-label="搜尋...">
                    <button class="btn btn-secondary my-2 my-sm-0 mr-1" type="submit">送出搜尋</button>
                    <button class="btn btn-warning my-2 my-sm-0" type="submit">儲存</button>
                </form>
            </div>
        </div>
    </div>

    <div class="row main-padding">
        <div class="col-12">
            <table class="table table-striped bg-white">
                <thead>
                <tr>
                    <th scope="col">班級</th>
                    <th scope="col">座號</th>
                    <th scope="col">姓名</th>
                    <th scope="col">姓別</th>
                    <th scope="col">帳號</th>
                    <th scope="col">密碼</th>
                    <th scope="col">原住民身分</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>三年甲班</td>
                        <td>{{ $student->seat_number }}</td>
                        <td>{{ $student->name }}</td>
                        <td>
                            <select class="form-control-sm">
                                <option>男</option>
                                <option>女</option>
                            </select>
                        </td>
                        <td>{{ $student->account }}</td>
                        <td>{{ $student->password }}</td>
                        <td>
                            <select class="form-control-sm">
                                <option>是</option>
                                <option>否</option>
                            </select>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">各項指標分數</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">指標</th>
                            <th scope="col">過往平均</th>
                            <th scope="col">滿分</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for($i=0;$i<=305;$i++)
                            <tr>
                                <td>A1發現團隊成員的觀點與能力</td>
                                <td>3</td>
                                <td>5</td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">確認</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>
@endsection
