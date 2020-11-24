@extends('layouts.master')
@section('title1', '個人學習專區')
@section('title2', '主頁 / 個人學習專區')
@section('content')
    <div class="row main-padding mb-2">
        <div class="col-12">
            <div class="float-right">
                <form action="{{ url('units') }}" class="form-inline float-right">
                    <input name="name" class="form-control mr-sm-2" type="search" placeholder="搜尋..."
                           aria-label="搜尋...">
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
                    <th scope="col">單元名稱</th>
                    <th scope="col">平均分</th>
                    <th scope="col">滿分</th>
                    <th scope="col">各項指標</th>
                    <th scope="col">測驗</th>
                </tr>
                </thead>
                <tbody>
                @foreach($units as $unit)
                    <tr>
                        <td>{{ $unit->name }}</td>
                        <td>{{ $unit->average_score() }}</td>
                        <td>{{ $unit->max_score() }}</td>
                        <td><a href="#" data-toggle="modal" data-target="#exampleModal">檢視</a></td>
                        <td>
                            <select name="is_open[{{$unit->id}}]" class="form-control-sm">
                                <option value="1" {{ ($unit->is_open == 1)? 'selected' : '' }}>公開</option>
                                <option value="0" {{ ($unit->is_open == 0)? 'selected' : '' }}>不公開</option>
                            </select>
                        </td>
                        <td><a href="{{ url('units/start/'.$unit->id) }}" class="btn btn-warning btn-sm">作答</a></td>
                        @if($user->role == 3)
                            <td>
                                <a href="{{ url('units/start/'.$unit->id) }}" class="btn btn-secondary btn-sm">送出審核</a>
                            </td>
                        @endif
                        <td>
                            <a href="{{ url('tasks') }}" class="btn btn-secondary btn-sm">複製</a>
                            <a href="{{ url('tasks?unit_id='.$unit->id) }}" class="btn btn-secondary btn-sm">編輯</a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-r btn-sm delete" data-toggle="modal"
                                    data-target="#deleteModal" data-keyword="單元"
                                    data-url="{{ url('units/'.$unit->id) }}">刪除
                            </button>
                        </td>
                    </tr>
                @endforeach
				<tr>
                        <td>單元名稱ＯＯＯＯＯＯＯＯＯＯＯＯＯＯＯ</td>
                        <td>22</td>
                        <td>30</td>
                        <td><a href="#" data-toggle="modal" data-target="#exampleModal">檢視</a></td>
                        <td><a href="{{ url('units/start/1') }}" class="btn btn-warning btn-sm">作答</a></td>
                    </tr>
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
                        @foreach($targets as $k=>$v)
                            <tr>
                                <td>{{ $v }}</td>
                                <td>3</td>
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

    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">新增單元</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('units') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>單元名稱</label>
                            <input name="name" type="text" class="form-control" placeholder="輸入單元名稱...">
                            <input name="is_open" type="number" value="0" hidden>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-r" value="確認">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">取消</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection