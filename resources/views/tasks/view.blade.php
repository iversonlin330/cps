@extends('layouts.master')
@section('title1', '任務列表')
@section('title2', '主頁 / 我的單元 / 任務列表')
@section('content')
    <div class="row main-padding mb-2">
        <div class="col-12">
            <div class="float-left">
                <button class="btn btn-warning" onclick="create_modal()">新增任務</button>
                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#orderModal">任務排序
                </button>
            </div>
            <!--div class="float-right">
                <form class="form-inline float-right">
                    <input class="form-control mr-sm-2" type="search" placeholder="搜尋..." aria-label="搜尋...">
                    <button class="btn btn-secondary my-2 my-sm-0 mr-1" type="submit">送出搜尋</button>
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">儲存</button>
              </form>
            </div-->
        </div>
    </div>

    <div class="row main-padding">
        <div class="col-12">
            <table class="table table-striped bg-white">
                <thead>
                <tr>
                    <th scope="col">任務名稱</th>
                    <th scope="col">預覽</th>
                    <th scope="col">動作</th>
                    <th scope="col">刪除任務</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->name }}</td>
                        <td><a href="{{ url('tasks/start/'.$task->id) }}">檢視</a></td>
                        <td>
                            <button type="button" class="btn btn-secondary btn-sm">複製</button>
                        <!--a href="{{ url('tasks/create?task_id='.$task->id) }}"
                               class="btn btn-secondary btn-sm">編輯</a-->
                            <button class="btn btn-secondary btn-sm"
                                    data-url="{{ url('tasks/'.$task->id) }}"
                                    data-count="{{ implode(',',$task->content['count']) }}"
                                    data-name="{{ $task->name }}"
                                    data-order="{{ $task->order }}"
                                    onclick="edit_modal(this)">編輯
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-r btn-sm delete" data-toggle="modal"
                                    data-target="#deleteModal" data-keyword="任務"
                                    data-url="{{ url('tasks/'.$task->id) }}">刪除
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">任務排序</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('tasks') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <ul id="group_sort">
                            @foreach($tasks as $task)
                                <li class="btn btn-light add-btn mt-2 btn-block">{{ $task->name }}
                                    <input name="update_order[]" value="{{ $task->id }}" hidden>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-secondary" value="確認">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">取消</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">新增任務</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('tasks') }}" method="post">
                    @csrf
                    <input type="text" name="unit_id" value="{{ $unit_id }}" hidden>
                    <input type="text" name="order" value="{{ $tasks->count()+1 }}" hidden>
                    <input type="text" name="content" value="" hidden>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>任務名稱</label>
                            <input name="name" type="text" class="form-control" placeholder="輸入任務名稱...">
                        </div>
                        <hr>
                        <div class="px-1">
                            <div class="row mb-2">
                                <div class="col-12">
                                    <a id="add-task" class="btn btn-r float-right" onclick="add_parent()">新增架構
                                    </a>
                                </div>
                            </div>
                            <div id="str" class="str">
                                <!--div class="row mb-2">
                                    <div class="col-10">
                                        <button class="btn btn-block btn-dark">1-1</button>
                                    </div>
                                    <div class="col-2">
                                        <a class="btn btn-light" onclick="add_sub(1)">＋</a>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="offset-2 col-8">
                                        <button class="btn btn-block btn-light">1-1-1</button>
                                    </div>
                                </div-->
                            </div>
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
        $("#group_sort").sortable();
        let str_array = [];

        function create_modal() {
            $("form").attr('action', "{{ url('tasks') }}");
            $("form").find("[name='name']").val('');
            $("[name='order']").val({{ $tasks->count()+1 }});
            str_array = [];
            refresh();
            $('#createModal').modal('show');
        }

        function edit_modal(obj) {
            let count = $(obj).data('count');
            let name = $(obj).data('name');
            let url = $(obj).data('url');
            let order = $(obj).data('order');

            $("[name='order']").val(order);

            $("form").attr('action', url);
            $("form").find("[name='name']").val(name);

            if (count.length > 2) {
                str_array = count.split(",");
            } else {
                str_array = [count];
            }

            refresh();
            $('#createModal').modal('show');
        }

        function add_parent() {
            // let length = str_array.length;
            // let newNo = length + 1;
            // str_array.push(newNo);
            str_array.push(1);
            refresh();
        }

        /*
                $("#add-task").click(function () {
                    let length = str_array.length;
                    let newNo = length + 1;
                    str_array.push(newNo);
                    let length = $("#str .col-10").length;
                    let newNo = length + 1;
                    $("#str").append("<div class=\"row mb-2\">\n" +
                        "                                <div class=\"col-10\" id='parent-" + newNo + "'>\n" +
                        "                                    <button class=\"btn btn-block btn-dark\">1-" + newNo + "</button>\n" +
                        "                                </div>\n" +
                        "                                <div class=\"col-2\">\n" +
                        "                                    <button class=\"btn btn-light\" onclick='add_sub(this)'>＋</button>\n" +
                        "                                </div>\n" +
                        "
                });
        */
        function add_sub(num) {
            /*
            //let parentNo = $(obj).data('parent');
            let newNo = str_array[num].length + 1;
            //$(obj).parent('div').find('row').after();
            str_array[num].push(newNo);
             */
            let newNo = str_array[num] + 1;
            str_array[num] = newNo;
            refresh();
        }

        function delete_sub(num) {
            /*
            //let parentNo = $(obj).data('parent');
            let newNo = str_array[num].length + 1;
            //$(obj).parent('div').find('row').after();
            str_array[num].push(newNo);
             */
            let newNo = str_array[num] - 1;
            if (newNo == 0) {
                str_array.splice(num, 1);
            } else {
                str_array[num] = newNo;
            }
            console.log(str_array);
            refresh();
        }

        function refresh() {
            let order = $("[name='order']").val();
            let html = "";
            for (let x = 1; x <= str_array.length; x++) {
                for (let y = 1; y <= str_array[x - 1]; y++) {
                    if (y == 1) {
                        html = html + "<div class=\"row mb-2\">\n" +
                            "              <div class=\"col-9\">\n" +
                            "                  <a class=\"btn btn-block btn-dark\">" + order + "-" + x + "</a>\n" +
                            "              </div>\n" +
                            "              <div class=\"col-3\">\n" +
                            "                  <button class=\"btn btn-light\" onclick=\"add_sub(" + (x - 1) + ")\">＋</button>\n" +
                            "                  <button class=\"btn btn-light\" onclick=\"delete_sub(" + (x - 1) + ")\">－</button>\n" +
                            "              </div>\n" +
                            //"              <div class=\"col-2\">\n" +
                            //"                  <a class=\"btn btn-light\" onclick=\"delete_sub(" + (x - 1) + ")\">－</a>\n" +
                            //"              </div>\n" +
                            "           </div>";
                        console.log(order + "-" + x);
                    } else {
                        html = html + "<div class=\"row mb-2\">\n" +
                            "              <div class=\"offset-1 col-8\">\n" +
                            "                  <a class=\"btn btn-block btn-light\">" + order + "-" + x + "-" + (y - 1) + "</a>\n" +
                            "              </div>\n" +
                            "          </div>";
                        console.log(order + "-" + x + "-" + (y - 1));
                    }

                }
            }
            $("#str").html(html);
            $("[name='content']").val(str_array);
        }
    </script>
@endsection
