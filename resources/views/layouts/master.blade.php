<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Styles -->
    <style>
    </style>
</head>
<body class="bg-color">
<div class="container-fluid">
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
	<nav class="navbar navbar-expand-lg navbar-light nav-custom" style="">
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
        </div>
      </li>
	</ul>
  </div>
</nav>
</div>
    @yield('content')
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<script>
	$(".menu").onclick(function(){
		
	});
		
	</script>
</div>

</body>
</html>
