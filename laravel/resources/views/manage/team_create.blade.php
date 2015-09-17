@extends('layouts.main')

@section('title', '新建团队')

@section('content')
<div class="col-md-2" role="complementary">
    <div class="list-group">
        <a href="#" class="list-group-item active">
            基本资料
        </a>
        <a href="#" class="list-group-item">订阅源</a>
        <a href="#" class="list-group-item">成员</a>
    </div>
</div>

<div class="col-md-7">
    <ol class="breadcrumb">
        <li><a href="{{route('manage.home')}}">返回 团队列表</a></li>
        <li>新建团队</li>
    </ol>
    <div class="panel panel-default panel-team">
        <div class="panel-body">
            {!!  Form::open(['route' => 'manage.team.store',"class"=>'form-horizontal', "files"=> true])  !!}
                <div class="form-group">
                    <label for="team_name" class="col-sm-2 control-label">团队名称</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="team_name" value="{{old('team_name')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">团队图标</label>
                    <div class="col-sm-10">
                        <img src="{{asset('img/icon.jpeg')}}" width="36" class="pull-left" style="margin-right: 10px" />
                        <input type="file" name="team_icon">
                    </div>
                </div>
                <div class="form-group">
                    <label for="team_intro" class="col-sm-2 control-label">团队介绍</label>
                    <div class="col-sm-10">
                        <textarea name="team_intro" class="form-control" rows="3">{{old('team_intro')}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default" onclick="this.disabled=true;this.innerHTML='正在创建，请稍等。';this.form.submit();;">提交，并添加订阅源</button>
                    </div>
                </div>
            {!! Form::close() !!}


            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>填入
                        信息有误,请检查</strong><br><br>
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
@endsection