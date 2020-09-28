@extends('layouts.master')
@section('title1', '新增任務')
@section('title2', '主頁 / 我的單元 / 任務列表 / 新增任務')
@section('content')
 <div class="row main-padding">
 <!-- Nav tabs -->
 <div class="col-11">
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active text-dark" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">1-1</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link text-dark" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">1-2</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link text-dark" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">1-3</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link text-dark" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">1-4</a>
  </li>
</ul>
</div>
<div class="col-1 ml-auto">
	<a href="{{ url('tasks') }}"  class="btn btn-warning">儲存</a>
</div>
<div class="col-12">
<!-- Tab panes -->
	<div class="tab-content" style="    max-height: 90vh;overflow-y: auto;">
	  <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
			<div class="d-flex justify-content-center" style="background-color: #fff5dd;">
				<div class="row" style="width:80%;">
					<div class="col-12 font-weight-bold mt-4" style="font-size:22px;">1-1</div>
					<div class="col-12 bg-white p-4">
						<div class="row mb-2">
							<div class="col-5 mt-2 font-weight-bold" style="font-size:22px;">題目敘述</div>
							<div class="col-3">
							<select class="form-control">
								<option>有選項欄位</option>
								<option>無選項欄位</option>
							</select>
							</div>
							<div class="col-4">
							<select class="form-control">
								<option>選擇測試指標</option>
								<option>A1發現團隊成員的觀點與能力</option>
								<option>A2依目標發現解決問題的合作模式</option>
							</select>
							</div>
						</div>
						<textarea class="form-control mb-2" placeholder="敘述一"></textarea>
						<textarea class="form-control mb-2" placeholder="敘述二"></textarea>
						<textarea class="form-control mb-2" placeholder="敘述三"></textarea>
						<textarea class="form-control mb-2" placeholder="敘述四"></textarea>
						<textarea class="form-control mb-2" placeholder="敘述五"></textarea>
						<div class="form-group">
							<label>圖片</label>
							<input name="account" type="text" class="form-control" placeholder="輸入圖片網址...">
						  </div>
						  <div class="mb-2 font-weight-bold" style="font-size:22px;">選項內容</div>
						  @for($i=0;$i<4;$i++)
						  <div class="row mb-2">
							  <div class="col-8">
								<textarea class="form-control" placeholder="選項一"></textarea>
								</div>
							<div class="col-2">
								<select class="form-control form-control-sm">
								<option>前往題組</option>
									<option>1-1-3</option>
									<option>1-1-4</option>
									<option>1-1-5</option>
								</select>
							</div>
							 <div class="col-2">
								<select class="form-control form-control-sm">
									<option>配分</option>
									<option>1</option>
									<option>5</option>
								</select>
							</div>
						</div>
						@endfor
					</div>
				</div>
			</div>
	  </div>
	  <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">1</div>
	  <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">2</div>
	  <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">2</div>
	</div>
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
</script>
@endsection

@endsection
