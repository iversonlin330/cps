@extends('layouts.master')
@section('title1', '所有單元')
@section('title2', '主頁 / 單元專區 / 所有單元')
@section('content')
    <div class="row main-padding mb-2">
        <div class="col-12">
            <div class="float-left">
                <a href="#" data-toggle="modal" data-target="#createModal" class="btn btn-warning">新增單元</a>
                <a href="{{ url('units/verify') }}" class="btn btn-dark">待審核單元</a>
            </div>
            <div class="float-right">
                <form action="{{ url('units') }}" class="form-inline float-right">
                    <input name="name" class="form-control mr-sm-2" type="search" placeholder="搜尋..."
                           aria-label="搜尋...">
                    <button class="btn btn-secondary my-2 my-sm-0 mr-1" type="submit">送出搜尋</button>
                    <a class="btn btn-warning my-2 my-sm-0" onclick="form_submit()">儲存</a>
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
                    <th scope="col">狀態</th>
                    <th scope="col">測驗</th>
                    <th scope="col">動作</th>
                    <th scope="col">刪除單元</th>
                </tr>
                </thead>
                <form id="unit_form" action="{{ url('units/update') }}" method="post">
                    @csrf
                    <tbody>
                    @foreach($units as $unit)
                        <tr>
                            <td>{{ $unit->name }}</td>
                            <td>{{ array_sum($unit->avg_score()) }}</td>
                            <td>{{ array_sum($unit->total_score()) }}</td>
                            <td><a href="#" class="target" data-toggle="modal" data-target="#target_modal"
                                   data-max="{{ json_encode($unit->total_score()) }}"
                                   data-avg="{{ json_encode($unit->avg_score()) }}">檢視</a></td>
                            <td>
                                <select name="unit_array[{{$unit->id}}][is_open]" class="form-control-sm">
                                    <option value="1" {{ ($unit->status == 1)? 'selected' : '' }}>公開</option>
                                    <option value="0" {{ ($unit->status == 0)? 'selected' : '' }}>不公開</option>
                                </select>
                            </td>
                            <td><a href="{{ url('units/start/'.$unit->id) }}" class="btn btn-warning btn-sm">作答</a></td>
                            <td>
                                <a href="{{ url('units/copy') }}" class="btn btn-secondary btn-sm">複製</a>
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
                    </tbody>
                </form>
            </table>
        </div>
    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="target_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <td id="avg_{{$k}}">3</td>
                                <td id="total_{{$k}}">5</td>
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
@section('script')
    <script>
        function form_submit() {
            $("#unit_form").submit();
        }
    </script>
@endsection
