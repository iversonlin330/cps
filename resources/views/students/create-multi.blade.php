@extends('layouts.master')
@section('title1', '新增多筆學生資料')
@section('title2', '資料設定 / 學生資料設定 / 新增多筆學生資料')
@section('content')
 <div class="row-fluid main-padding">
	<div class="row" style="padding-top:24px">
			<div class="col-12">
				<div class="d-flex justify-content-center">
					<div class="login-title " style="width:540px;">
						<p class="-Login text-center">新增多筆學生資料</p>
					</div>
				</div>
				<div class="d-flex justify-content-center">
					<div class="login-content" style="width:540px;">
						<form action="{{ url('students/create-multi') }}" method="post">
							@csrf
							<div class="form-group row">
								<label for="inputEmail3" class="col-3 col-form-label">學校</label>
								<div class="col-4">
                                    <select name="city_id" class="form-control">
                                        @foreach($citys as $city => $school)
                                            <option value="{{ $city }}">{{ $city }}</option>
                                        @endforeach
                                    </select>
								</div>
								<div class="col-5">
                                    <select name="school_id" class="form-control">
                                        <option>文德國小</option>
                                    </select>
								</div>
							  </div>

							<div class="form-group row">
								<label for="inputEmail3" class="col-3 col-form-label">資料筆數</label>
								<div class="col-9">
								  <input name="number" type="number" class="form-control" id="inputEmail3">
								</div>
							  </div>

							<div class="d-flex justify-content-center">
								<input type="submit" class="btn btn-r" style="width: 83px;" value="儲存">
							</div>
						</form>
					</div>
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
        $("[name='city_id']").trigger('change');
    </script>
@endsection
