@extends('layouts.master')
@section('title1', '考卷作答')
@section('title2', '首頁 / 我的考卷 / 考卷作答')
@section('content')
    <div class="row-fluid main-padding">
        <div class="row" style="padding-top:24px">
            <div class="col-12">
                <div class="d-flex exam-title bg-brown">
                    <div class="mr-auto mt-4 ml-4">
                        <p class="-Login">{{ $exam->name }}</p>
                    </div>
                    <!--div class="mt-2 mr-4">
                        <p class="-Login" style="font-size: 40px;">14:39</p>
                    </div-->
                </div>
            </div>
        </div>
        <form id="exam_form" action="{{ url('exams/start/'.$exam->id) }}" method="post">
            @csrf
            @foreach($exam->units() as $unit_index => $unit)
                @php
                    $task_count = count($unit->tasks);
                @endphp
                @foreach($unit->tasks as $task_index => $task)
                    @php
                        $q_id = 0;
                    @endphp
                    @foreach($task['content']['count'] as $index => $q_count)
                        @for($i = 0; $i < $q_count; $i++)
                            <div class="col-12">
                                <div id="q_{{ $unit_index }}_{{ $task_index }}_{{ $q_id }}" class="row question"
                                     style="padding-top:24px;display: none;">
                                    <div class="col-6 pr-0" style="background-color: #fff5dd;">
                                        <div class="pl-4 exam-content bg-brown">
                                            <div class="row">
                                                <div class="col-12 mt-4 exam-content-title">題目</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 mt-4 exam-content-text">
                                                    <ul>
                                                        @if($task['content']['desc1'][$q_id])
                                                            <li>{{ $task['content']['desc1'][$q_id] }}</li>
                                                        @endif
                                                        @if($task['content']['desc2'][$q_id])
                                                            <li>{{ $task['content']['desc2'][$q_id] }}</li>
                                                        @endif
                                                        @if($task['content']['desc3'][$q_id])
                                                            <li>{{ $task['content']['desc3'][$q_id] }}</li>
                                                        @endif
                                                        @if($task['content']['desc4'][$q_id])
                                                            <li>{{ $task['content']['desc4'][$q_id] }}</li>
                                                        @endif
                                                        @if($task['content']['desc5'][$q_id])
                                                            <li>{{ $task['content']['desc5'][$q_id] }}</li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 mt-4 exam-content-title">選項</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 mt-4 exam-content-text">
                                                    @if($task['content']['is_item'][$q_id])
                                                        @for($j = 0; $j < 5; $j++)
                                                            @if($task['content']['question'][$q_id][$j])
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                           name="answer[{{$task->id}}][{{$index}}][{{$q_id}}]"
                                                                           value="{{ $task['content']['score'][$q_id][$j] }}"
                                                                           data-goto="{{ $task['content']['goto'][$q_id][$j] }}"
                                                                           data-task="{{ $task_index }}"
                                                                           data-unit="{{ $unit_index }}"
                                                                           data-task-count="{{ $task_count }}"
                                                                           onclick="goto(this)">
                                                                    <label class="form-check-label"
                                                                           for="exampleRadios1">
                                                                        {{ $task['content']['question'][$q_id][$j] }}
                                                                    </label>
                                                                </div>
                                                            @endif
                                                        @endfor
                                                    @else
                                                        <a class="btn btn-r"
                                                           data-goto="{{ $task['content']['goto_no_item'][$q_id] }}"
                                                           data-task="{{ $task_index }}"
                                                           data-unit="{{ $unit_index }}"
                                                           data-task-count="{{ $task_count }}"
                                                           onclick="goto(this)">前往下一題</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 pl-0">
                                        <div class="d-flex justify-content-center exam-img bg-white p-4">
                                            @if(array_key_exists('pic',$task['content']))
                                                @if(array_key_exists($q_id,$task['content']['pic']))
                                                    <img class="m-auto"
                                                         src="{{ asset('storage/'.$task['content']['pic'][$q_id]) }}"
                                                         alt="">
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $q_id++;
                                @endphp
                            </div>
                        @endfor
                    @endforeach
                @endforeach
            @endforeach
        </form>
    </div>
@endsection
@section('script')
    <script>
        let unit_length = {!! count($exam->units()) !!};
        $(".question:first").show();

        function goto(obj) {
            let unit = $(obj).data('unit');
            let task = $(obj).data('task');
            let goto = $(obj).data('goto');
            let task_count = $(obj).data('task-count');
            $(".question").hide();

            console.log(unit + "_" + task + "_" + goto);
            console.log(task_count);
            console.log(unit);
            if (goto == "next") {
                task = task + 1;
                if (task == task_count) {
                    unit = unit + 1;
                    if (unit == unit_length) {
                        $("#exam_form").submit();
                    } else {
                        console.log("next_unit#q_" + unit + "_0_0");
                        $("#q_" + unit + "_0_0").show();
                    }
                } else {
                    console.log("next_task#q_" + unit + "_0_0");
                    $("#q_" + unit + "_" + task + "_0").show();
                }
            } else {
                $("#q_" + unit + "_" + task + "_" + goto).show();
            }
        }
    </script>
@endsection

