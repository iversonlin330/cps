@extends('layouts.master')
@section('title1', isset($classroom)? '編輯班級' : '新增班級')
@section('title2', '資料設定 / 班級資料設定 / '.(isset($classroom)? '編輯班級' : '新增班級'))
@section('content')
    <div class="row-fluid main-padding">
        <form action="{{ isset($classroom)? url('classrooms/'.$classroom->id) : url('classrooms') }}" method="post">
            @if(isset($classroom))
                @method('PUT')
            @endif
            @csrf
            <div class="row" style="">
                <div class="col-12">
                    <div>1. 輸入班級名稱</div>
                    <div class="form-group row">
                        <div class="col-1">
                            <select name="grade" class="form-control">
                                <option>一</option>
                                <option>二</option>
                                <option>三</option>
                                <option>四</option>
                                <option>五</option>
                                <option>六</option>
                            </select>
                        </div>
                        <label class="col-form-label">年</label>
                        <div class="col-1">
                            <input class="form-control" type="number" name="class" required>
                        </div>
                        <label class="col-form-label">班</label>
                    </div>
                    <div>* 若文字編班，則按順序填數字，如：甲、乙、丙，請填寫1、2、3。</div>
                    <div>2. 選擇該班級學生</div>
                </div>
            </div>
            <div class="row" style="padding-top:24px">
                <div class="col-1">
                </div>
                <div class="col-5">
                    <div class="d-flex justify-content-center">
                        <div class="login-title " style="width:100%;">
                            <p class="-Login text-center">學生資料</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center bg-white table-scroll">
                        <table id="table_pool" class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">學生編號</th>
                                <th scope="col">學生姓名</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($students as $student)
                                <tr onclick="add(this)">
                                    <td>{{ $student->account }}<input type="text"
                                                                                          name="student_id[]"
                                                                                          value="{{ $student->id }}"
                                                                                          hidden>
                                    </td>
                                    <td>{{ $student->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="login-buttom" style="width:100%;"></div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="d-flex justify-content-center">
                        <div class="login-title " style="width:100%; background-color: #f5c323;">
                            <p class="-Login text-center">已選取學生</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center bg-white table-scroll">
                        <table id="select_table" class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">學生編號</th>
                                <th scope="col">學生姓名</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($selected))
                                @foreach($selected as $student)
                                    <tr onclick="remove_selected(this)">
                                        <td>{{ $student->account }}<input type="text" name="student_id[]"
                                                                          value="{{ $student->id }}" hidden>
                                        </td>
                                        <td>{{ $student->name }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="login-buttom" style="width:100%; background-color: #f5c323;"></div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <input type="submit" class="btn btn-r" style="width: 83px;margin-top:20px;" value="儲存">
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        /*
        $("table").sortable({
            items: 'tbody > tr',
            connectWith: "table"
        });
*/
        function add(obj){
            $(obj).clone().attr('onclick','remove_selected(this)').appendTo("#select_table tbody");
            $(obj).remove();
        }

        function remove_selected(obj){
            $(obj).clone().attr('onclick','add(this)').appendTo("#table_pool tbody");
            $(obj).remove();
        }

        $('form').submit(function () {
            $("#table_pool input").remove();
        });

        @if(isset($classroom))
        let classroom = @json($classroom);
        $("[name='class']").val(classroom['class']);
        $("[name='grade']").val(classroom['grade']);
        @endif
    </script>
@endsection
