@extends('layouts.master')
@section('title1', '班級學習成績')
@section('title2', '主頁 / 作答及成績 / 班級學習成績')
@section('content')
    <div class="row main-padding mb-2">
        <div class="col-12">
            <div class="float-right">
                <form action="{{ url('exams/score') }}" class="form-inline float-right">
                    <select name="cycle_id" class="form-control mr-sm-2">
                        @foreach($cycles as $cycle)
                            <option value="{{ $cycle->id }}">{{ $cycle->getRange() }}</option>
                        @endforeach
                    </select>
                    <select name="city_id" class="form-control mr-sm-2">
                        @foreach($citys as $city => $school)
                            <option value="{{ $city }}">{{ $city }}</option>
                        @endforeach
                    </select>
                    <select name="school_id" class="form-control mr-sm-2">
                        <option value="">學校</option>
                    </select>
                    <input name="name" class="form-control mr-sm-2" type="search" placeholder="搜尋..."
                           aria-label="搜尋...">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">送出搜尋</button>
                </form>
            </div>
        </div>
    </div>

    <div class="row main-padding">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">考卷名稱</th>
                    <th scope="col">組合單元</th>
                    <th scope="col">考試學校</th>
                    <th scope="col">考試班級</th>
                    <th scope="col">班平均分</th>
                    <th scope="col">滿分</th>
                    <th scope="col">班各項指標</th>
                    <th scope="col">學生指標</th>
                    <th scope="col">資料匯出</th>
                </tr>
                </thead>
                <tbody>
                @for($i=0;$i<0;$i++)
                    <tr>
                        <td>考卷名稱ＯＯＯＯＯ</td>
                        <td>單元Ａ/單元B/單元C</td>
                        <td>新北市立新埔國小</td>
                        <td>三年甲班</td>
                        <td>22</td>
                        <td>30</td>
                        <td><a href="#" data-toggle="modal" data-target="#viewModal">檢視</a></td>
                        <td><a href="{{ url('exams/score-detail') }}">檢視</a></td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm">匯出</button>
                        </td>
                    </tr>
                @endfor
                @foreach($exams as $exam)
                    @foreach($exam->classrooms->where('cycle_id',$data['cycle_id']) as $classroom)
                        @if(array_key_exists('school_id',$data))
                            @if($data['school_id'] == $classroom->school)
                                @if(strpos($data['name'], $exam->name))
                                    <tr>
                                        <td>{{ $exam->name }}</td>
                                        <td>{{ implode('/',$exam->units()->pluck('name')->toArray()) }}</td>
                                        <td>{{ $classroom->school->fullName() }}</td>
                                        <td>{{ $classroom->fullName() }}</td>
                                        <td>{{ array_sum($exam->avg_class_score($classroom->id)) }}</td>
                                    <!--td>{{ array_sum($exam->avg_score()) }}</td-->
                                        <td>{{ array_sum($exam->total_score()) }}</td>
                                        <td><a href="#" class="target" data-toggle="modal" data-target="#target_modal"
                                               data-my="{{ json_encode($exam->avg_class_score($classroom->id)) }}"
                                               data-total="{{ json_encode($exam->total_score()) }}"
                                               data-avg="{{ json_encode($exam->avg_score()) }}">檢視</a></td>
                                        <td>
                                            <a href="{{ url('exams/score-detail/'.$exam->id.'/'.$classroom->id) }}">檢視</a>
                                        </td>
                                        <td>
                                            <a href="{{ url('exams/score-export/'.$exam->id.'/'.$classroom->id) }}"
                                               class="btn btn-warning btn-sm">匯出</a>
                                        </td>
                                    </tr>
                                @endif
                            @endif
                        @endif
                    @endforeach
                @endforeach
                @if($tutor_classroom)
                    @if($tutor_classroom->exams)
                        @foreach($tutor_classroom->exams as $exam)
                            @if(array_key_exists('school_id',$data))
                                @if($data['school_id'] == $classroom->school)
                                    @if(strpos($data['name'], $exam->name))
                                        @continue
                                    @endif
                                @endif
                            @endif
                            <tr>
                                <td>{{ $exam->name }}</td>
                                <td>{{ implode('/',$exam->units()->pluck('name')->toArray()) }}</td>
                                <td>{{ $classroom->school->fullName() }}</td>
                                <td>{{ $classroom->fullName() }}</td>
                                <td>{{ array_sum($exam->avg_class_score($classroom->id)) }}</td>
                            <!--td>{{ array_sum($exam->avg_score()) }}</td-->
                                <td>{{ array_sum($exam->total_score()) }}</td>
                                <td><a href="#" class="target" data-toggle="modal" data-target="#target_modal"
                                       data-my="{{ json_encode($exam->avg_class_score($classroom->id)) }}"
                                       data-total="{{ json_encode($exam->total_score()) }}"
                                       data-avg="{{ json_encode($exam->avg_score()) }}">檢視</a></td>
                                <td>
                                    <a href="{{ url('exams/score-detail/'.$exam->id.'/'.$classroom->id) }}">檢視</a>
                                </td>
                                <td>
                                    <a href="{{ url('exams/score-export/'.$exam->id.'/'.$classroom->id) }}"
                                       class="btn btn-warning btn-sm">匯出</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Button trigger modal -->


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
                            <th scope="col">學生分數</th>
                            <th scope="col">過往平均</th>
                            <th scope="col">滿分</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($targets as $k=>$v)
                            <tr>
                                <td>{{ $v }}</td>
                                <td id="my_{{$k}}">3</td>
                                <td id="avg_{{$k}}">4</td>
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
        var citys = @json($citys);
        $("[name='city_id']").change(function () {
            var city_val = $(this).val();
            $("[name='school_id']").empty();
            var html = '';
            for (x in citys[city_val]) {
                html = html + "<option value='" + x + "'>" + citys[city_val][x] + "</option>";
            }
            $("[name='school_id']").append(html);
        });

        @if(array_key_exists('school_id',$data))
        $("[name='school_id']").val({{ $data['school_id'] }});
        $("[name='cycle_id']").val({{ $data['cycle_id'] }});
        @endif
        $("[name='city_id']").trigger('change');
    </script>
@endsection
