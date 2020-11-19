@extends('layouts.master')
@section('title1', '新增考卷')
@section('title2', '主頁 / 我的考卷 / 新增考卷')
@section('content')
    <div class="row-fluid main-padding">
        <form action="{{ url('exams') }}" method="post">
            @csrf
            <div class="row" style="padding-top:24px">
                <div class="col-12">
                    <div>1. 輸入考卷名稱</div>
                    <div class="col-3">
                        <input name="name" type="text" class="form-control" id="inputEmail3" placeholder="考卷名稱">
                    </div>
                    <div>2. 選取欲組合單元</div>
                </div>
            </div>
            <div class="row" style="padding-top:24px">
                <div class="col-4">
                    <div class="d-flex justify-content-center">
                        <div class="login-title " style="width:390px;">
                            <p class="-Login text-center">公開單元</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center bg-white table-scroll">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">預覽</th>
                                <th scope="col">單元名稱</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($myUnits as $unit)
                                <tr onclick="add({{ $unit->id }});">
                                    <td><a href="{{ url('units/start/'.$unit->id) }}" target="_blank">檢視</a></td>
                                    <td>{{ $unit->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="login-buttom"></div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="d-flex justify-content-center">
                        <div class="login-title " style="width:390px;">
                            <p class="-Login text-center">我的單元</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center bg-white table-scroll">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">預覽</th>
                                <th scope="col">單元名稱</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($openUnits as $unit)
                                <tr>
                                    <td><a href="{{ url('units/start/'.$unit->id) }}" target="_blank">檢視</a></td>
                                    <td>{{ $unit->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="login-buttom"></div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="d-flex justify-content-center">
                        <div class="login-title " style="width:390px; background-color: #f5c323;">
                            <p class="-Login text-center">已選取考券</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center bg-white table-scroll">
                        <table id="select_table" class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">單元名稱</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i=0;$i<=500;$i++)
                                <tr>
                                    <td>單元名稱ＯＯＯＯＯ</td>
                                    <td>X</td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="login-buttom" style="background-color: #f5c323;"></div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <input type="submit" class="btn btn-r" style="width: 83px;margin-top:20px;" value="下一步">
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        let select_units = [];

        function refresh() {
            $("#select_table tbody").empty();
            for (x in select_units) {
                $("#select_table tbody").append("<tr>\n" +
                    "                                    <td>" + select_units[x]['name'] + "</td>\n" +
                    "                                    <td onclick='remove(" + select_units[x]['unit_id'] + ")'>X</td>\n" +
                    "                                </tr>");
            }
            $("#select_table tbody").append();
        }

        function add(obj) {
            let name = $(obj).data('name');
            let unit_id = $(obj).data('unit_id');
            let new_array = [];
            new_array['name'] = name;
            new_array['unit_id'] = unit_id;
            select_units.push(new_array);
            refresh();
        }

        function remove(unit_id) {
            for (x in select_units) {
                if (select_units[x]['unit_id'] == unit_id) {
                    select_units.splice(x, 1);
                }
            }
            refresh();
        }
    </script>
@endsection
