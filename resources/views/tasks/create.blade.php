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
                    @foreach($task->content['count'] as $index => $q_count)
                        <div class="tab-pane" id="tab_{{ $index }}" role="tabpanel" aria-labelledby="home-tab">
                            <div class="d-flex justify-content-center" style="background-color: #fff5dd;">
                                <div class="row" style="width:80%;">
                                    @for( $sub = 0; $sub < $q_count; $sub++)
                                        <div class="col-12 font-weight-bold mt-4" style="font-size:22px;">
                                            {{ $task->order }}-{{ $index+1 }}{{ ($sub == 0)? '' : '-' . $sub }}
                                        </div>
                                        <div class="col-12 bg-white p-4">
                                            <div class="row mb-2">
                                                <div class="col-5 mt-2 font-weight-bold" style="font-size:22px;">題目敘述
                                                </div>
                                                <div class="col-3">
                                                    <select name="is_item[{{$q_id}}]" class="form-control is_item_select"
                                                            data-qid="{{ $q_id }}" onchange="item_change(this)"
                                                            required>
                                                        <option value="1" selected>有選項欄位</option>
                                                        <option value="0">無選項欄位</option>
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <select name="target[{{$q_id}}]" class="form-control" required>
                                                        @foreach($targets as $k=>$v)
                                                            <option value="{{ $k }}">{{ $v }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <textarea class="form-control mb-2" placeholder="敘述一"
                                                      name="desc1[{{$q_id}}]" required></textarea>
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
                                                                <option value="next">前往下一任務</option>
                                                                @for( $goto = $sub+1; $goto < $q_count; $goto++)
                                                                    <option
                                                                        value="{{ $map[$index][$goto] }}">{{ $task->order }}
                                                                        -{{ $index+1 }}{{ ($goto == 0)? '' : '-' . $goto }}</option>
                                                                @endfor
                                                                @if($index < count($task->content['count'])-1)
                                                                    <option
                                                                        value="{{ $map[$index+1][0] }}">{{ $task->order }}
                                                                        -{{ $index+2 }}</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="col-2">
                                                            <select name="score[{{$q_id}}][{{$i}}]"
                                                                    class="form-control form-control-sm">
                                                                <!--option disabled selected hidden>配分
                                                                </option-->
                                                                @for($j=1; $j<=$scoreNum; $j++)
                                                                    <option value="{{ $j }}" selected>{{ $j }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endfor
                                            </div>
                                            <div id="no_item_{{ $q_id }}" style="display:none">
                                                <select name="goto_no_item[{{$q_id}}]"
                                                        class="form-control form-control-sm">
                                                    <option value="next">前往下一任務</option>
                                                    @for( $goto = $sub+1; $goto < $q_count; $goto++)
                                                        <option value="{{ $map[$index][$goto] }}">{{ $task->order }}
                                                            -{{ $index+1 }}{{ ($goto == 0)? '' : '-' . $goto }}</option>
                                                    @endfor
                                                    @if($index < count($task->content['count'])-1)
                                                        <option
                                                            value="{{ $map[$index+1][0] }}">{{ $task->order }}
                                                            -{{ $index+2 }}</option>
                                                    @endif
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
@endsection
@section('script')
    <script>
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            e.target; // newly activated tab
            e.relatedTarget; // previous active tab
        });
        $("#submit_btn").click(function () {
            $('#main_form').submit();
        });

        function item_change(obj) {
            let is_item = $(obj).val();
            let qid = $(obj).data('qid');
            if (is_item == 1) {
                $("#is_item_" + qid).show();
                $("#no_item_" + qid).hide();
            } else {
                $("#is_item_" + qid).hide();
                $("#no_item_" + qid).show();
            }
        }

        $("#myTab a:eq(0)").click();

            @if(isset($task->content['question']))
        let content = @json($task->content);
        console.log(content);
        for (let x in content) {
            content[x].forEach(function (value, i) {
                if (Array.isArray(value)) {
                    console.log(value);
                    for (let y in value) {
                        $("[name='" + x + "[" + i + "][" + y + "]']").val(value[y]);
                    }
                } else {
                    $("[name='" + x + "[" + i + "]']").val(value);
                }
            });
        }
        $(".is_item_select").trigger('change');
        @endif

    </script>
@endsection
