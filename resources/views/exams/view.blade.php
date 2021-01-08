@extends('layouts.master')
@php
    $text = Request::is('*my*')? '我的考卷' : '所有考卷';
@endphp
@section('title1', $text)
@section('title2', '主頁 / 考卷專區 / '.$text)
@section('content')
    <div class="row main-padding mb-2">
        <div class="col-12">
            <div class="float-left">
                @if($text == "我的考卷")
                    <a type="button" class="btn btn-warning" href="{{ url('exams/create') }}">新增考卷</a>
                @endif
            </div>
            <div class="float-right">
                <form action="{{ url()->current() }}" class="form-inline float-right">
                    <input name="name" class="form-control mr-sm-2" type="search" placeholder="搜尋..."
                           aria-label="搜尋...">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">送出搜尋</button>
                </form>
            </div>
        </div>
    </div>

    <div class="row main-padding">
        <div class="col-12">
            <table class="table table-striped bg-white">
                <thead>
                <tr>
                    <th scope="col">考卷名稱</th>
                    <th scope="col">組合單元</th>
                    <th scope="col">平均分</th>
                    <th scope="col">滿分</th>
                    <th scope="col">各項指標</th>
                    <th scope="col">測驗</th>
                    <th scope="col">指派考卷</th>
                    <th scope="col">動作</th>
                    <th scope="col">刪除考卷</th>
                </tr>
                </thead>
                <tbody>
                @foreach($exams as $exam)
                    @if($data)
                        @if(strpos($data['name'], $exam->name) === false)
                            @continue
                        @endif
                    @endif
                    <tr>
                        <td>{{ $exam->name }}</td>
                        <td>{{ implode('/',$exam->units()->pluck('name')->toArray()) }}</td>
                        <td>{{ array_sum($exam->avg_score()) }}</td>
                        <td>{{ array_sum($exam->total_score()) }}</td>
                        <td><a href="#" class="target" data-toggle="modal" data-target="#target_modal"
                               data-total="{{ json_encode($exam->total_score()) }}"
                               data-avg="{{ json_encode($exam->avg_score()) }}">檢視</a></td>
                        <td><a href="{{ url('exams/start/'.$exam->id) }}" class="btn btn-warning btn-sm">作答</a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-secondary btn-sm assign" data-toggle="modal"
                                    data-target="#assignModal" data-exam-id="{{ $exam->id }}"
                                    data-classroom="{{ json_encode($exam->classrooms->pluck('id')->toArray()) }}"
                                    data-value="{{ json_encode($exam->teacher_classroom()) }}">指派考卷
                            </button>
                        </td>
                        <td>
                            <a href="{{ url('exams/copy/'.$exam->id) }}" class="btn btn-secondary btn-sm">複製</a>
                            @if(!$exam->is_answer())
                                <a href="{{ url('exams/'.$exam->id.'/edit') }}"
                                   class="btn btn-secondary btn-sm">編輯</a>
                            @endif
                        </td>
                        <td>
                            @if(!$exam->is_answer() || $user->role == 9)
                                <button type="button" class="btn btn-r btn-sm delete" data-toggle="modal"
                                        data-target="#deleteModal" data-keyword="考卷"
                                        data-url="{{ url('exams/'.$exam->id) }}">刪除
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">指派考卷</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('exams/assign') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        @if($user->role == 9)
                            <div class="row">
                                <div class="col-6">
                                    <select name="city_id" class="form-control mr-sm-2">
                                        @foreach($citys as $city => $school)
                                            <option value="{{ $city }}">{{ $city }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <select name="school_id" class="form-control mr-sm-2">
                                        <option value="">學校</option>
                                    </select>
                                </div>
                            </div>
                        @endif
                        <table class="table">
                            <thead class="thead-r">
                            <tr>
                                @if($user->role == 9)
                                    <th scope="col">學校</th>
                                @endif
                                <th scope="col">班級</th>
                                <th scope="col">選取</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($classrooms as $classroom)
                                <tr>
                                    <td>{{ $classroom->fullName() }}</td>
                                    <td><input type="checkbox" name="classroom_id[]" value="{{ $classroom->id }}"></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary">確認</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">取消</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                            <!--th scope="col">學生分數</th-->
                            <th scope="col">過往平均</th>
                            <th scope="col">滿分</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($targets as $k=>$v)
                            <tr>
                                <td>{{ $v }}</td>
                                <!--td id="student_{{$k}}">0</td-->
                                <td id="avg_{{$k}}">0</td>
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
@endsection
@section('script')
    <script>
        $(document).on('click', '.assign', function () {
            let classroom = $(this).data('classroom');
            let exam_id = $(this).data('exam-id');
            let value = $(this).data('value');
            console.log(value);

            $("#assignModal form").attr('action', "{{ url('exams/assign') }}/" + exam_id);
            /*
                        $("input[name='classroom_id[]']").prop('checked', false);
                        for (let x in classroom) {
                            $("input[value='" + classroom[x] + "']").prop('checked', true);
                        }*/
            $("#assignModal tbody").empty();
            let html = '';
            for (let x in value) {
                html = html + "<tr data-id='" + value[x]['school_id'] + "'>";
                @if($user->role == 9)
                    html = html + "<td>" + value[x]['school_name'] + "</td>";
                @endif
                    html = html + "<td>" + value[x]['name'] + "</td>";
                html = html + "<td><input type='checkbox'' name='classroom_id[]' value=" + value[x]['classroom_id'] + " " + value[x]['status'] + "></td>";
                html = html + "</td>";
                html = html + "</tr>";
            }
            $("#assignModal tbody").html(html);
            @if($user->role == 9)
            $("[name='city_id']").trigger('change');
            $("[name='school_id']").trigger('change');
            @endif
        });

        @if($user->role == 9)
        var citys = @json($citys);
        $("[name='city_id']").change(function () {
            var city_val = $(this).val();
            $("[name='school_id']").empty();
            var html = '';
            for (x in citys[city_val]) {
                html = html + "<option value='" + x + "'>" + citys[city_val][x] + "</option>";
            }
            $("[name='school_id']").append(html)
            $("[name='school_id']").trigger('change');
        });

        $("[name='school_id']").change(function () {
            var school_val = $(this).val();
            console.log(school_val);
            $("#assignModal tbody tr").hide();
            $("#assignModal tbody tr[data-id='" + school_val + "']").show();
        });

        $("[name='city_id']").trigger('change');
        $("[name='school_id']").trigger('change');
        @endif

    </script>
@endsection
