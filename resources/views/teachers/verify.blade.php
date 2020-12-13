@extends('layouts.master')
@section('title1', '教師資料設定')
@section('title2', '資料設定 / 教師資料設定 / 待審核教師資料')
@section('content')
 <div class="row main-padding mb-2">
        <div class="col-12">
	<div class="float-right">
		<form action="{{ url('teachers/verify') }}" class="form-inline float-right">
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
                    <button class="btn btn-secondary my-2 my-sm-0 mr-1" type="submit">送出搜尋</button>
					<a class="btn btn-warning my-2 my-sm-0" onclick="update()">儲存</a>
                </form>
	</div>
</div>
</div>
<form id="user_form" action="{{ url('/teachers/verify') }}" method="post">
        @csrf
 <div class="row main-padding">
        <div class="col-12">
	<table class="table table-striped">
  <thead>
    <tr>
	<th scope="col">姓名</th>
      <th scope="col">學校</th>
	  <th scope="col">性別</th>
      <th scope="col">帳號</th>
      <th scope="col">密碼</th>
	  <th scope="col">電子信箱</th>
	  <th scope="col">教師編號</th>
	  <th scope="col">審核</th>
    </tr>
  </thead>
  <tbody>
	@foreach($users as $user)
		<tr>
			<td>{{ $user->name }}</td>
			<td>{{ $user->school->fullName() }}</td>
			<td>{{ config('map.gender')[$user->gender] }}</td>
			<td>{{ $user->account }}</td>
			<td>{{ $user->password }}</td>
			<td>{{ $user->email }}</td>
			<td>{{ $user->teacherid }}</td>
			<td>
				<select name="teacher_array[{{$user->id}}][is_verify]" class="form-control-sm">
                                    <option value="0" {{ ($user->is_verify == 0)? 'selected' : '' }}>待審核</option>
                                    <option value="1" {{ ($user->is_verify == 1)? 'selected' : '' }}>通過</option>
                                </select>
			</td>
		</tr>
	@endforeach
  </tbody>
</table>
</div>
</div>
</form>
        
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
		
		function update() {
            $('#user_form').submit();
        }
    </script>
@endsection
