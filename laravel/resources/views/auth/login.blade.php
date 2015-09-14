@extends('layouts.auth')

@section('title', '登陆')

@section('content')
            {!!  Form::open(['url' => 'auth/login'])  !!}
            <p class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                <input type="text" class="form-control " name="email" placeholder="邮箱" value="{{ old('email') }}" />
            </p>
            <p class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                <input type="password" class="form-control " name="password" placeholder="密码"/>
            </p>

            <p>
                <button type="submit" class="btn btn-success btn-block">登陆</button>
            </p>

            <p class="help-block">
                <a href="{{route("password.forget")}}">忘记密码?</a>
                <span class="pull-right">没有帐号,<a href="{{route("register")}}">点此注册</a></span>
            </p>

            {!!  Form::close() !!}

@stop