<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>@yield('title') - TeamDIGG</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <style>
/*
feed.css
*/
        .list-feed img.pull-left {  width: 48px; margin-right: 10px }
        .list-feed h5,
        .list-feed h5 {  margin-top: 4px;margin-bottom: 4px; font-weight: bold}
        .list-feed span{
            color :#CCC;
        }

/*
team.css
*/
        .panel-team .team-icon{
            width: 20px;
            height: 20px;
        }

/*
common.css
*/
        footer div{
            border-top: 1px #CCC dashed;
            padding: 10px;
            margin-top: 10px;
            color: #CCC
        }
    </style>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">TeamDIGG</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li @if($routename == "home") class="active" @endif><a href="{{route("home")}}">动态</a></li>
                <li @if(substr($routename,0,6) == "manage") class="active" @endif><a href="{{route("manage.home")}}">管理</a></li>
                <li @if($routename == "discover") class="active" @endif><a href="#">发现</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="navbar-text">您好,{{$user->name}}</li>
                <li><a href="{{route("logout")}}">退出</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    @yield('content')

    <div class="col-md-3">
        <div class="well">
            <img src="{{asset('img/ad.jpg')}}" width="218">
        </div>
    </div>

</div>
<footer>
    <div class="container" >
        <p class="text-center"  >
            TeamDIGG.com - 关于我们 - 意见反馈 - 粤ICP备72367816号
        </p>
    </div>
</footer>

</body>
</html>