@extends('layouts.auth')

@section('title', '重置密码')


@section('content')
            {!!  Form::open(['url' => 'password/reset'])  !!}
            {!! Form::hidden('token', $token) !!}
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
                <button type="submit" class="btn btn-success btn-block">重置密码</button>
            </p>
            {!!  Form::close() !!}

@stop