@extends('layouts.master')
@section('title1', '學校窗口資料設定')
@section('title2', '資料設定 / 學校窗口資料設定')
@section('content')
    <div class="row main-padding mb-2">
        <div class="col-12">
            <div class="float-left">
                <a href="{{ url('contacts/create') }}" class="btn btn-warning">新增窗口帳號</a>
            </div>
            <div class="float-right">
                <form action="{{ url('contacts') }}" class="form-inline float-right">
                    <select name="city" class="form-control mr-sm-2">
                        <option value="">縣市</option>
                    </select>
                    <select name="school" class="form-control mr-sm-2">
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
            <table class="table table-striped bg-white">
                <thead>
                <tr>
                    <th scope="col">學校</th>
                    <th scope="col">姓名</th>
                    <th scope="col">帳號</th>
                    <th scope="col">密碼</th>
                    <th scope="col">電子信箱</th>
                    <th scope="col">動作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->city . $user->school }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->account }}</td>
                        <td>{{ $user->password }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ url('contacts/'.$user->id.'/edit') }}" class="btn btn-warning btn-sm">編輯</a>
                            <button type="button" class="btn btn-warning btn-sm delete" data-toggle="modal"
                                    data-target="#deleteModal" data-keyword="窗口"
                                    data-url="{{ url('contacts/'.$user->id) }}">刪除
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Button trigger modal -->

@endsection
@section('script')
    <script>

    </script>
@endsection
