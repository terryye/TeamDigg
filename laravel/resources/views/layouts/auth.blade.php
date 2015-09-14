<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>@yield('title') - TeamDIGG</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <style>
        .main {
            margin: 10% auto 0 auto;
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
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{route("login")}}">登陆</a></li>
                <li><a href="{{route("register")}}">注册</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container main">
    <div class="row">
        <div class="col-md-6 col-md-offset-1">
            <img src="{{ URL::asset('img/logos.png') }}" style="margin-right: 20px; width: 60px;" class="pull-left">
            <p>
                <span style="font-size: 30px; font-weight: bold">TeamDIGG</span>
                <br />为团队打造的订阅,分享工具.
            </p>
        </div>


        <div class="col-md-3">
            @yield('content')

            @unless(empty($status))
                <div class="alert alert-info">
                    {{ $status }}
                </div>
            @endunless

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>填入信息有误,请检查</strong><br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
</body>
</html>