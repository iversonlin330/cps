@extends('layouts.master')
@section('title1', '單元作答')
@section('title2', '首頁 / 我的單元 / 單元作答')
@section('content')
    <div class="row-fluid main-padding">
        <div class="row" style="padding-top:24px">
            <div class="col-12">
                <div class="d-flex exam-title bg-grey">
                    <div class="mr-auto mt-4 ml-4">
                        <p class="-Login">{{ $task->name }}</p>
                    </div>
                    <!--div class="mt-2 mr-4">
                        <p class="-Login" style="font-size: 40px;">14:39</p>
                    </div-->
                </div>
            </div>
        </div>
        <form id="task_form" action="{{ url('tasks/start/'.$task->id) }}" method="post">
		@csrf
                @php
                    $q_id = 0;
					$task_index = 0;
                @endphp
                @foreach($task['content']['count'] as $index => $q_count)
                    @for($i = 0; $i < $q_count; $i++)
                        <div id="q_{{ $task_index }}_{{ $q_id }}" class="row question"
                             style="padding-top:24px;display: none;">
                            <div class="col-6 pr-0">
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
                                                                   name="answer[{{$task->id}}][{{$q_id}}]"
                                                                   value="{{ $task['content']['score'][$q_id][$j] }}"
                                                                   data-goto="{{ $task['content']['goto'][$q_id][$j] }}"
                                                                   data-task="{{ $task_index }}" onclick="goto(this)">
                                                            <label class="form-check-label" for="exampleRadios1">
                                                                {{ $task['content']['question'][$q_id][$j] }}
                                                            </label>
                                                        </div>
                                                    @endif
                                                @endfor
                                            @else
                                                <a class="btn btn-r" data-goto="{{ $task['content']['goto_no_item'][$q_id] }}" data-task="{{ $task_index }}" onclick="goto(this)">前往下一題</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 pl-0">
                                <div class="d-flex justify-content-center exam-img bg-white p-4">
                                    <img class="m-auto"
                                         src="{{ $task['content']['pic'][$q_id] }}" alt="">
                                </div>
                            </div>
                        </div>
                        @php
                            $q_id++;
                        @endphp
                    @endfor
                @endforeach
        </form>
    </div>
@endsection
@section('script')
    <script>
		let task_length = 1;
        $(".question:first").show();

        function goto(obj) {
            let task = $(obj).data('task');
            let goto = $(obj).data('goto');

            if (goto == "next") {
                task = task + 1;
				if (task == task_length) {
                    $("#task_form").submit();
                } else {
                    $(".question").hide();
                    $("#q_" + task + "_0").show();
                }
            } else {
                $(".question").hide();
                $("#q_" + task + "_" + goto).show();
            }
        }
    </script>
@endsection
