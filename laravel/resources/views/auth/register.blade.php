@extends('layouts.auth')

@section('title', '注册')


@section('content')
            {!!  Form::open(['url' => 'auth/register'])  !!}
            <p class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                <input type="text" class="form-control " name="name" placeholder="昵称" value="{{ old('name') }}" />
            </p>
            <p class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                <input type="text" class="form-control " name="email" placeholder="邮箱" value="{{ old('email') }}" />
            </p>
            <p class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                <input type="password" class="form-control " name="password" placeholder="密码"  value="{{ old('password') }}"  />
            </p>
            <p class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                <input type="password" class="form-control " name="password_confirmation" placeholder="再次输入密码"  value="{{ old('password_confirmation') }}"  />
            </p>
            <p>
                <button type="submit" class="btn btn-success btn-block">注 册</button>
            </p>
            <p class="help-block">已有帐号,点此 <a href="{{url("/auth/login")}}">登录</a> </p>
            {!!  Form::close() !!}

@stop