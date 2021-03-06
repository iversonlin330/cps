<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CPS評量系統</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Styles -->
    <style>
    </style>
</head>
<body class="bg-color">
<div class="container-fluid" style="height:auto;padding-bottom:101px;">
    <div class="row master-banner">
        <div class="col-12 center-block text-center">
            <div class="master-cps">CPS</div>
        </div>
    </div>
    <!--div class="row master-banner2">
        <div class="col-12">
			<div class="d-inline master-banner2-menu">回主頁</div>
            <div class="d-inline master-banner2-menu float-right text-center menu" style="width:130px">選單列</div>
			<div></div>
			<div class="d-inline master-banner2-menu float-right">Hi, Admin</div>
        </div>
    </div-->
    <div class="row">
        <!--nav class="navbar navbar-expand-lg navbar-light nav-custom" style="">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link text-white" href="#">回主頁<span class="sr-only">(current)</span></a>
          </li>
        </ul>
        <ul class="navbar-nav my-2">
        <li class="nav-item active">
            <a class="nav-link text-white" href="#">Hi, Admin<span class="sr-only">(current)</span></a>
          </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              選單列
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
                <li class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle" href="#">Second subsubmenu</a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Subsubmenu action</a></li>
                      <li><a class="dropdown-item" href="#">Another subsubmenu action</a></li>
                    </ul>
                  </li>
            </div>
          </li>
        </ul>
      </div>
    </nav-->
        @if(0)
            <nav class="navbar navbar-expand-lg navbar-light nav-custom">
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link text-white" href="{{  url('main') }}">回主頁 <span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <!--li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown link
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li class="dropdown-submenu">
                              <a class="dropdown-item dropdown-toggle" href="#">Submenu</a>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Submenu action</a></li>
                                <li><a class="dropdown-item" href="#">Another submenu action</a></li>


                                <li class="dropdown-submenu">
                                  <a class="dropdown-item dropdown-toggle" href="#">Subsubmenu</a>
                                  <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Subsubmenu action</a></li>
                                    <li><a class="dropdown-item" href="#">Another subsubmenu action</a></li>
                                  </ul>
                                </li>
                                <li class="dropdown-submenu">
                                  <a class="dropdown-item dropdown-toggle" href="#">Second subsubmenu</a>
                                  <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Subsubmenu action</a></li>
                                    <li><a class="dropdown-item" href="#">Another subsubmenu action</a></li>
                                  </ul>
                                </li>
                              </ul>
                            </li>
                          </ul>
                        </li-->
                    </ul>
                    <ul class="navbar-nav my-2">
                        <li class="nav-item active">
                            <span class="nav-link text-white">Hi, {{ Auth::user()->name }}</span>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="http://example.com"
                               id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                選單列
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Submenu</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Submenu action</a></li>
                                        <li><a class="dropdown-item" href="#">Another submenu action</a></li>


                                        <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle" href="#">Subsubmenu</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">Subsubmenu action</a></li>
                                                <li><a class="dropdown-item" href="#">Another subsubmenu action</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle" href="#">Second subsubmenu</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">Subsubmenu action</a></li>
                                                <li><a class="dropdown-item" href="#">Another subsubmenu action</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        @endif

        <nav class="navbar navbar-expand navbar-light nav-custom">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="main_nav">

                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link text-white" href="{{  url('main') }}">
                            <div class="home-icon bg-white text-brown d-inline-flex">
                                <i class="fas fa-home fa-lg icon"></i>
                            </div>
                            回主頁 <span class="sr-only">(current)</span>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li><span class="nav-link text-white">Hi, {{ Auth::user()->name }}</span></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle text-white" href="#" data-toggle="dropdown"
                           aria-expanded="false"> 選單列 </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            @if(Auth::user()->role == 9)
                                <li><a class="dropdown-item dropdown-toggle" href="#"> 考卷專區 </a>
                                    <ul class="submenu submenu-left dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ url('exams/my') }}">我的考卷</a></li>
                                        <li><a class="dropdown-item" href="{{ url('exams') }}">所有考卷</a></li>
                                    </ul>
                                </li>

                                <li><a class="dropdown-item dropdown-toggle" href="#">單元專區</a>
                                    <ul class="submenu submenu-left dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ url('units/my') }}">我的單元</a></li>
                                        <li><a class="dropdown-item" href="{{ url('units') }}">所有單元</a></li>
                                        <li><a class="dropdown-item" href="{{ url('units/verify') }}">待審核單元</a></li>
                                    </ul>
                                </li>

                                <li><a class="dropdown-item dropdown-toggle" href="#">作答記錄及成績</a>
                                    <ul class="submenu submenu-left dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ url('exams/score') }}">班級學習成績</a></li>
                                        <li><a class="dropdown-item" href="{{ url('units/score') }}">單元學習成績</a></li>
                                    </ul>
                                </li>

                                <li><a class="dropdown-item dropdown-toggle" href="#">資料設定</a>
                                    <ul class="submenu submenu-left dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ url('students') }}">學生資料設定</a></li>
                                        <li><a class="dropdown-item" href="{{ url('teachers') }}">教師資料設定</a></li>
                                        <li><a class="dropdown-item" href="">待審核教師資料</a></li>
                                        <li><a class="dropdown-item" href="{{ url('contacts') }}">學校窗口資料</a></li>
                                    </ul>
                                </li>
                            @elseif(Auth::user()->role == 4)
                                <li><a class="dropdown-item" href="{{ url('exams/my') }}">我的考卷</a>
                                <li><a class="dropdown-item" href="{{ url('units/my') }}">我的單元</a>
                                <li><a class="dropdown-item" href="{{ url('units') }}">所有單元</a>
                                <li><a class="dropdown-item" href="{{ url('exams/score') }}">班級學習成績</a>
                                <li><a class="dropdown-item" href="{{ url('users/teacher-edit') }}">個人資料設定</a>
                                <li><a class="dropdown-item" href="{{ url('classrooms/teacher-view') }}">班級資料設定</a>
                            @elseif(Auth::user()->role == 3)
                                <li><a class="dropdown-item" href="{{ url('exams/student-view') }}">班級考卷</a>
                                <li><a class="dropdown-item" href="{{ url('units/student-view') }}">個人學習專區</a>
                                <li><a class="dropdown-item" href="{{ url('exams/student-score') }}">班級學習成績</a>
                                <li><a class="dropdown-item" href="{{ url('units/student-score') }}">個人學習成績</a>
                                <li><a class="dropdown-item" href="{{ url('users/contact-edit') }}">密碼修改</a>
                            @elseif(Auth::user()->role == 2)
                                <li><a class="dropdown-item" href="{{ url('classrooms') }}">班級資料設定</a>
                                <li><a class="dropdown-item" href="{{ url('/users/contact-teachers-edit') }}">教師資料設定</a>
                                <li><a class="dropdown-item" href="{{ url('/users/contact-edit') }}">個人資料設定</a>
                            @elseif(Auth::user()->role == 1)
                                <li><a class="dropdown-item" href="{{ url('units/student-view') }}">公開單元</a>
                                <li><a class="dropdown-item" href="{{ url('units/student-score') }}">作答記錄</a>
                            @endif
                            <li><a class="dropdown-item" href="{{ url('logout') }}">登出</a>
                        </ul>
                    </li>
                </ul>

            </div> <!-- navbar-collapse.// -->
        </nav>
    </div>
    <div class="row main-padding">
        <div class="col-12">
            <div style="font-size: 22px;margin-top:40px;">@yield('title1')</div>
            <div>@yield('title2')</div>
            <hr/>
        </div>
    </div>
@yield('content')
<!-- Modal -->
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">刪除<span class="keyword"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    該<span class="keyword"></span>刪除後，將影響學生各項成績，請問您確定要刪除？？
                </div>
                <div class="modal-footer">
                    <form action="" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="submit" class="btn btn-secondary" value="確認"></input>
                    </form>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">刪除<span class="keyword"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    該<span class="keyword"></span>刪除後，將影響學生各項成績，請問您確定要刪除？？
                </div>
                <div class="modal-footer">
                    <form action="" method="POST">
                        @csrf
                        <input type="submit" class="btn btn-secondary" value="確認"></input>
                    </form>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!--script src="https://code.jquery.com/jquery-1.12.4.js"></script-->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        /*
        $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
      if (!$(this).next().hasClass('show')) {
        $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
      }
      var $subMenu = $(this).next('.dropdown-menu');
      $subMenu.toggleClass('show');


      $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
        $('.dropdown-submenu .show').removeClass('show');
      });


      return false;
    });
            */

        $(document).on('click', '.dropdown-menu', function (e) {
            e.stopPropagation();
        });

        // make it as accordion for smaller screens
        if ($(window).width() < 992) {
            $('.dropdown-menu a').click(function (e) {
                //e.preventDefault();
                if ($(this).next('.submenu').length) {
                    $(this).next('.submenu').toggle();
                }
                $('.dropdown').on('hide.bs.dropdown', function () {
                    $(this).find('.submenu').hide();
                })
            });
        }

        $(document).on('click', '.delete', function () {
            let url = $(this).attr('data-url');
            let keyword = $(this).attr('data-keyword');
            $('#deleteModal form').attr('action', url);
            $('#deleteModal .keyword').text(keyword);
        });

        $(document).on('click', '.post', function () {
            let url = $(this).attr('data-url');
            let keyword = $(this).attr('data-keyword');
            $('#postModal form').attr('action', url);
            $('#postModal .keyword').text(keyword);
        });

		$(document).on('click', '.target', function () {
            let total_score = $(this).data('total');
			let average_score = $(this).data('avg');
            let my_score = $(this).data('my');

			for(x in total_score){
				$("#total_"+x).text(total_score[x]);
			}

			for(x in average_score){
				$("#avg_"+x).text(average_score[x]);
			}

            for(x in my_score){
                $("#my_"+x).text(my_score[x]);
            }
        });

		$(".btn:contains('複製')").css('background-color','#DADADA');
        $(".btn:contains('複製')").css('color','#3F3F3F');
        $(".btn:contains('複製')").hover(function(){
            $(this).css("background-color", "#B4B4B4");
        }, function(){
            $(this).css("background-color", "#DADADA");
        });

    </script>
    @yield('script')
</div>

</body>
</html>
