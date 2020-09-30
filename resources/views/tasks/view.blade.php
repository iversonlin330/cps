@extends('layouts.master')
@section('title1', '任務列表')
@section('title2', '主頁 / 我的單元 / 任務列表')
@section('content')
    <div class="row main-padding mb-2">
        <div class="col-12">
            <div class="float-left">
                <a href="#" data-toggle="modal" data-target="#createModal" class="btn btn-warning">新增任務</a>
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
                @for($i=0;$i<=5;$i++)
                    <tr>
                        <td>確定使用何種方式進行調查</td>
                        <td><a href="#" data-toggle="modal" data-target="#exampleModal">檢視</a></td>
                        <td>
                            <button type="button" class="btn btn-secondary btn-sm">複製</button>
                            <button type="button" class="btn btn-secondary btn-sm">編輯</button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-r btn-sm">刪除</button>
                        </td>
                    </tr>
                @endfor
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
                <div class="modal-body">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">任務名稱</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for($i=0;$i<=305;$i++)
                            <tr>
                                <td>確定使用何種方式進行調查</td>
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
@endsection
