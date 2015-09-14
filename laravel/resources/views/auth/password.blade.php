@extends('layouts.auth')

@section('title', '找回密码')

@section('content')
            {!!  Form::open(['url' => 'password/email'])  !!}
            <p class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                <input type="text" class="form-control " name="email" placeholder="邮箱" value="{{ old('email') }}" />
            </p>

            <p>
                <button type="submit" class="btn btn-success btn-block">找回密码</button>
            </p>

            {!!  Form::close() !!}

            @if (session('status'))
                <div class="alert alert-info">
                    {{ session('status') }}
                </div>
            @endif
@stop