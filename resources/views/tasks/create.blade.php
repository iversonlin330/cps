@extends('layouts.master')
@section('title1', '新增任務')
@section('title2', '主頁 / 我的單元 / 任務列表 / 新增任務')
@section('content')
    <div class="row main-padding">
        <!-- Nav tabs -->
        <div class="col-11">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach($task->content['count'] as $index => $value)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-dark" data-toggle="tab" href="#tab_{{ $index }}" role="tab"
                           aria-controls="tab_{{ $index }}" aria-selected="false">{{ $task->order }}-{{ $index+1 }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-1 ml-auto">
            <a id="submit_btn" class="btn btn-warning">儲存</a>
        </div>
        <div class="col-12">
            <form id="main_form" action="{{ url('tasks/'.$task->id) }}" method="post">
                @method("put")
                @csrf
                <div class="tab-content" style="max-height: 90vh;overflow-y: auto;">
                    <!-- Tab panes -->
                    <input type="text" name="count" value="{{ implode(',',$task->content['count']) }}" hidden>
                    @php
                        $q_id = 0;
                    @endphp
                    @foreach($task->content['count'] as $index => $value)
                        <div class="tab-pane" id="tab_{{ $index }}" role="tabpanel" aria-labelledby="home-tab">
                            <div class="d-flex justify-content-center" style="background-color: #fff5dd;">
                                <div class="row" style="width:80%;">
                                    @for( $sub = 0; $sub < $value; $sub++)
                                        <div class="col-12 font-weight-bold mt-4" style="font-size:22px;">
                                            {{ $task->order }}-{{ $index+1 }}{{ ($sub == 0)? '' : '-' . $sub }}
                                        </div>
                                        <div class="col-12 bg-white p-4">
                                            <div class="row mb-2">
                                                <div class="col-5 mt-2 font-weight-bold" style="font-size:22px;">題目敘述
                                                </div>
                                                <div class="col-3">
                                                    <select name="is_item[{{$q_id}}]" class="form-control" data-qid="{{ $q_id }}" onchange="item_change(this)">
                                                        <option value="1">有選項欄位</option>
                                                        <option value="0">無選項欄位</option>
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <select name="target[{{$q_id}}]" class="form-control">
                                                        <option>選擇測試指標</option>
                                                        @foreach($targets as $k=>$v)
                                                            <option value="{{ $k }}">{{ $v }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <textarea class="form-control mb-2" placeholder="敘述一"
                                                      name="desc1[{{$q_id}}]"></textarea>
                                            <textarea class="form-control mb-2" placeholder="敘述二"
                                                      name="desc2[{{$q_id}}]"></textarea>
                                            <textarea class="form-control mb-2" placeholder="敘述三"
                                                      name="desc3[{{$q_id}}]"></textarea>
                                            <textarea class="form-control mb-2" placeholder="敘述四"
                                                      name="desc4[{{$q_id}}]"></textarea>
                                            <textarea class="form-control mb-2" placeholder="敘述五"
                                                      name="desc5[{{$q_id}}]"></textarea>
                                            <div class="form-group">
                                                <label>圖片</label>
                                                <input name="pic[{{$q_id}}]" type="text" class="form-control"
                                                       placeholder="輸入圖片網址...">
                                            </div>
                                            <div id="is_item_{{ $q_id }}">
                                                <div class="mb-2 font-weight-bold" style="font-size:22px;">選項內容
                                                </div>
                                                @for($i=0;$i<=4;$i++)
                                                    <div class="row mb-2">
                                                        <div class="col-8">
                                                    <textarea name="question[{{$q_id}}][{{$i}}]"
                                                              class="form-control"
                                                              placeholder="選項{{config('map.chineseNum')[$i+1]}}"></textarea>
                                                        </div>
                                                        <div class="col-2">
                                                            <select name="goto[{{$q_id}}][{{$i}}]"
                                                                    class="form-control form-control-sm">
                                                                <option>前往題組</option>
                                                                @for( $goto = $sub+1; $goto < $value; $goto++)
                                                                    <option value="{{ $goto }}">{{ $task->order }}
                                                                        -{{ $index+1 }}{{ ($goto == 0)? '' : '-' . $goto }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        <div class="col-2">
                                                            <select class="form-control form-control-sm">
                                                                <option name="score[{{$q_id}}][{{$i}}]">配分
                                                                </option>
                                                                @for($j=1;$j<=$scoreNum;$j++)
                                                                    <option value="{{ $j }}">{{ $j }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endfor
                                            </div>
                                            <div id="no_item_{{ $q_id }}">
                                                <select name="goto[{{$q_id}}]"
                                                        class="form-control form-control-sm">
                                                    <option>前往題組</option>
                                                    @for( $goto = $sub+1; $goto < $value; $goto++)
                                                        <option value="{{ $goto }}">{{ $task->order }}
                                                            -{{ $index+1 }}{{ ($goto == 0)? '' : '-' . $goto }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        @php
                                            $q_id++;
                                        @endphp
                                    @endfor
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </form>
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
                <div class="modal-body">
                    <form action="{{ url('login') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>單元名稱</label>
                            <input name="account" type="text" class="form-control" placeholder="輸入單元名稱...">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="{{ url('tasks') }}" class="btn btn-r">確認</a>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>

@section('script')
    <script>
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            e.target // newly activated tab
            e.relatedTarget // previous active tab
        })

        $("#submit_btn").click(function () {
            $('#main_form').submit();
        });

        function item_change(obj){
            let is_item = $(obj).val();
            let qid = $(obj).data('qid');
            if(is_item == 1){
                $("#is_item_"+qid).show();
                $("#no_item_"+qid).hide();
            }else{
                $("#is_item_"+qid).hide();
                $("#no_item_"+qid).show();
            }
        }
    </script>
@endsection

@endsection
