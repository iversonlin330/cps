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
            <form id="main_form" action="{{ url('tasks/'.$task->id) }}" method="post" enctype="multipart/form-data">
                @method("put")
                @csrf
                <div class="tab-content" style="max-height: 90vh;overflow-y: auto;">
                    <!-- Tab panes -->
                    <input type="text" name="count" value="{{ implode(',',$task->content['count']) }}" hidden>
                    <input type="text" name="status" value="1" hidden>
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
                                                <div class="col-3 ml-auto">
                                                    <select name="is_item[{{$q_id}}]"
                                                            class="form-control is_item_select"
                                                            data-qid="{{ $q_id }}" onchange="item_change(this)"
                                                            required>
                                                        <option value="1" selected>有選項欄位</option>
                                                        @if($sub != 0)
                                                            <option value="0">無選項欄位</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                @if($sub == 0)
                                                    <div class="col-4">
                                                        <select name="target[{{$index}}]" class="form-control" required>
                                                            @foreach($targets as $k=>$v)
                                                                <option value="{{ $k }}">{{ $v }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endif
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
                                                <div class="row">
                                                    <div class="col-4">
                                                        <input name="pic[{{$q_id}}]" type="file"
                                                               class="form-control-file"
                                                               placeholder="輸入圖片網址..." accept="image/*">
                                                    </div>
                                                    <div class="col-8">
                                                        <label class="form-check-label">（非必填）檔案大小限制為2MB，圖片格式僅可使用JPG檔、PNG檔</label>
                                                    </div>
                                                </div>
                                                <!--div class="custom-file mb-3">
    <input type="file" class="custom-file-input" id="validatedCustomFile" required>
    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
  </div-->
                                            </div>
                                            <div id="is_item_{{ $q_id }}">
                                                <div class="mb-2 font-weight-bold" style="font-size:22px;">選項內容
                                                </div>
                                                @for($i=0;$i<=4;$i++)
                                                    <div class="row mb-2 item_area" data-index="{{ $index }}"
                                                         data-sub="{{ $sub }}" data-qid="{{ $q_id }}">
                                                        <div class="col-8">
                                                    <textarea name="question[{{$q_id}}][{{$i}}]"
                                                              class="form-control"
                                                              placeholder="選項{{config('map.chineseNum')[$i+1]}}" {{ ($i==0)? 'required': '' }}></textarea>
                                                        </div>
                                                        <div class="col-2">
                                                            <select name="goto[{{$q_id}}][{{$i}}]"
                                                                    class="form-control form-control-sm"
                                                                    data-qid="{{$q_id}}" data-i="{{$i}}">
                                                                <option value=""></option>
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
                                                                    class="form-control form-control-sm"
                                                                    data-qid="{{$q_id}}" data-i="{{$i}}">
                                                                <!--option disabled selected hidden>配分
                                                                </option-->
                                                                @for($j=0; $j<=$scoreNum; $j++)
                                                                    <option
                                                                        value="{{ $j }}" {{ ($j==0)? 'selected' : '' }}>{{ $j }}</option>
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
            $('[disabled]').prop("disabled", false);
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

        function findMaxScore(qid) {
            let max_score = 0;
            $(".item_area[data-qid=" + qid + "] select[name^='score']").each(function () {
                let option_val = $(this).find("option:selected").val();
                let i = $(this).data('i');
                if (option_val > max_score) {
                    let goto = $("[name='goto[" + qid + "][" + i + "]'] option:selected").val();
                    if (goto == "next") {
                        max_score = option_val;
                    }
                }
            });
            return max_score;
        }

        $(".item_area select").change(function () {
            let index = $(this).closest('.item_area').data('index');
            let p_sub = $(this).closest('.item_area').data('sub');
            //console.log(p_sub);
            let qid = $(this).data('qid');
            let i = $(this).data('i');
            let goto = $("[name='goto[" + qid + "][" + i + "]'] option:selected").val();
            let score = $("[name='score[" + qid + "][" + i + "]'] option:selected").val();

            let max_score = findMaxScore(qid);
            //console.log(max_score);

            $(".item_area select[name^='score']").each(function () {
                let tmp_qid = $(this).data('qid');
                if (tmp_qid > qid) {
                    $(this).val(0);
                }
            });

            if (p_sub > 0) {
                let parent_select = $('.item_area select[name^="goto"]:has(option[value="' + qid + '"]:selected)');
                let parent_qid = $(parent_select).data('qid');
                let parent_i = $(parent_select).data('i');
                let parent_score = $("[name='score[" + parent_qid + "][" + parent_i + "]'] option:selected").val();
                let parent_max_score = findMaxScore(parent_qid);
                max_score = parent_max_score - parent_score;
            }


            $(".item_area[data-qid=" + qid + "] select[name^='goto']").each(function () {
                let other_goto = $(this).val();

                if (other_goto == "") {
                    return;
                }

                let other_i = $(this).data('i');

                if (other_i == i) {
                    return;
                }

                let other_score = $("[name='score[" + qid + "][" + other_i + "]'] option:selected").val();
                let temp_goto = goto;

                if (other_goto == "next") {
                    other_goto = -1;
                }

                if (goto == "next") {
                    temp_goto = -1;
                }

                if (other_goto <= temp_goto) {
                    if (score >= other_score) {
                        $("[name='score[" + qid + "][" + i + "]']").val(0);
                    }
                }

                if (other_goto >= temp_goto) {
                    if (score <= other_score) {
                        $("[name='score[" + qid + "][" + other_i + "]']").val(0);
                    }
                }
            });


            $(".item_area[data-qid=" + qid + "] select[name^='score']").each(function () {
                let option_val = $(this).find("option:selected").val();
                let i = $(this).data('i');
                let goto = $("[name='goto[" + qid + "][" + i + "]'] option:selected").val();
                if (goto != "next" || p_sub != 0) {
                    if (parseInt(option_val) >= parseInt(max_score)) {
                        $(this).val(0);
                        //max_score = option_val;
                    }
                }
            });

            /*
            $(".item_area[data-qid='" + goto + "'] select[name^='score']").each(function () {
                $(this).empty();
                if (score == 0) {
                    $(this).html(create_option(0));
                } else {
                    $(this).html(create_option(score - 1));
                }

            });
            */
        });

        /*

		function findMaxScore(index) {
            let max_score = 0;
            $(".item_area[data-index=" + index + "][data-sub=0] select[name^='score']").each(function () {
                let option_val = $(this).find("option:selected").val();
                if (option_val > max_score) {
                    max_score = option_val;
                }
            });
            return max_score;
        }

        $(".item_area select").change(function () {
            let index = $(this).closest('.item_area').data('index');
            let p_sub = $(this).closest('.item_area').data('sub');
            //console.log(p_sub);
            let qid = $(this).data('qid');
            let i = $(this).data('i');
            let goto = $("[name='goto[" + qid + "][" + i + "]'] option:selected").val();
            let score = $("[name='score[" + qid + "][" + i + "]'] option:selected").val();

            $(".item_area[data-qid='" + goto + "'] select[name^='score']").each(function () {
                $(this).empty();
                if (score == 0) {
                    $(this).html(create_option(0));
                } else {
                    $(this).html(create_option(score - 1));
                }

            });
        });
*/
        function create_option(num) {
            let html = "";
            for (let i = 0; i <= num; i++) {
                html = html + "<option>" + i + "</option>";
            }
            return html;
        }

        $("#myTab a:eq(0)").click();
        @if(isset($task->content['question']))
        let content = @json($task->content);
        for (let x in content) {
            if (x == "pic") {
                continue;
            }
            content[x].forEach(function (value, i) {
                if (!value) {
                    return;
                }
                if (Array.isArray(value)) {
                    for (let y in value) {
                        $("[name='" + x + "[" + i + "][" + y + "]']").val(value[y]);
                        $("[name='" + x + "[" + i + "][" + y + "]']").trigger('change');
                    }
                } else {
                    $("[name='" + x + "[" + i + "]']").val(value);
                    $("[name='" + x + "[" + i + "]']").trigger('change');
                }
            });
        }
        $(".is_item_select").trigger('change');
        @endif
        @if(isset($disabled))
        @if($disabled == 1)
        $("[name^='is_item']").prop('disabled', true);
        $("[name^='target']").prop('disabled', true);
        $("[name^='score']").prop('disabled', true);
        $("[name^='goto']").prop('disabled', true);
        @endif
        @endif
    </script>
@endsection
