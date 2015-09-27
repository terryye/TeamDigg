@extends('layouts.manage_team')

@section('title', '修改团队资料')

@section('breadcrumb')
    <li><a href="{{route('manage.home')}}">返回 团队列表</a></li>
    <li>成员:{{$team->team_name}}</li>
@endsection

@section('form')
    <div class="panel panel-default panel-member">
        <div class="panel-heading">
            <button class="btn btn-info btn-xs" type="button">设为会员</button>
            <button class="btn btn-info btn-xs" type="button">设为管理员</button>
            <button class="btn btn-info btn-xs" type="button">删除成员</button>
            <button class="btn btn-info btn-xs" type="button">加入黑名单</button>

            <button class="btn btn-info btn-xs pull-right" type="button">邀请朋友</button>
        </div>
        <div class="panel-body">
            <table class="table table-hover table-striped" >
                <thead>
                <tr>
                    <td style="width: 10px">#</td>
                    <td style="width: 160px" >
                        <b>昵称</b>
                    </td>
                    <td style="width: 60px" >
                       <b>角色</b>
                    </td>
                    <td class="text-center">
                        <form class="form-inline" role="search" action="{{route('manage.team.member',['team_id'=>$team->team_id])}}">
                            <input type="text" name="nick" style="width: 100px" class="form-control input-sm" placeholder="输入昵称" value="{{$nick}}">
                            <!--
                            {!! Form::select('role', array_merge(['0'=>'选择角色'],$role_map),null, ['class'=>'form-control  input-sm']) !!}
                                    -->
                            <button type="submit" class="btn btn-info btn-xs">搜索</button>
                        </form>
                    </td>
                </tr>
                </thead>
                <tbody>
                @foreach($team_users as $team_user)
                <tr>
                    <td>
                        @if($team_user->pivot->user_role != APP\Role::TEAM_FOUNDER)
                            <input type="checkbox" value="{{$team_user->id}}">
                         @endif
                    </td>
                    <td><img class="member-icon" src="./img/tagicon/101.png" />{{$team_user->name}}</td>
                    <td>{{$role_map[$team_user->pivot->user_role]}}</td>
                    <td>{{$team_user->intro}}</td>
                </tr>
                @endforeach
                <!--
                <tr>
                    <td><input type="checkbox"></td>
                    <td><img class="member-icon" src="./img/tagicon/101.png" />叶腾飞terryye</td>
                    <td>管理员</td>
                    <td>微信公众号：霍老爷的小木屋</td>
                </tr>

                <tr>
                    <td><input type="checkbox"></td>
                    <td><img class="member-icon" src="./img/tagicon/101.png" /> 叶腾飞terryye</td>
                    <td>成员</td>
                    <td></td>
                </tr>

                <tr>
                    <td><input type="checkbox"></td>
                    <td><img class="member-icon" src="./img/tagicon/101.png" /> 叶腾飞terryye</td>
                    <td>待审核</td>
                    <td></td>

                </tr>
                -->
                </tbody>
            </table>
            <nav class="pull-right">
                    {!! $team_users->render() !!}
            </nav>
        </div>
    </div>
@endsection