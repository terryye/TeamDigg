@extends('layouts.manage_team')

@section('title', '修改团队资料')

@section('breadcrumb')
    <li><a href="{{route('manage.home')}}">返回 团队列表</a></li>
    <li>成员:{{$team->team_name}}</li>
@endsection

@section('form')
    <div class="panel panel-default panel-member">
        <div class="panel-heading">
            <form class="form-inline" role="search"
                  action="{{route('manage.team.member',['team_id'=>$team->team_id])}}">
                <input type="text" name="nick" style="width: 100px" class="form-control input-sm" placeholder="输入昵称"
                       value="{{$nick}}">
                <!--
                            {!! Form::select('role', array_merge(['0'=>'选择角色'],$role_map),null, ['class'=>'form-control  input-sm']) !!}
                        -->
                <button type="submit" class="btn btn-info btn-xs">搜索</button>

                <button class="btn btn-info btn-xs pull-right" type="button">邀请朋友</button>
            </form>
        </div>
        <div class="panel-body">
            <table class="table table-hover table-striped">
                <tbody>
                @foreach($team_users as $team_user)
                    <tr>
                        <td>
                            <img class="member-icon" src="{{asset('img/tagicon/101.png')}}"/>
                            <span title="用户ID:{{$team_user->id}}
{{$team_user->intro}}">{{$team_user->name}}
                            </span>
                        </td>
                        <td style="width: 100px" class="text-right">

                            @if($team_user->pivot->user_role == APP\Role::TEAM_FOUNDER)
                                {{$role_map[$team_user->pivot->user_role]}}
                            @else
                                <div class="dropdown">
                                    <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button"
                                       aria-haspopup="true"
                                       aria-expanded="false">                                  {{$role_map[$team_user->pivot->user_role]}}
                                        <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" aria-labelledby="dLabel">
                                        @foreach($role_change as $role_id => $role)
                                            @if($role_id != $team_user->pivot->user_role)
                                                <li>
                                                    <a href="#"
                                                       onclick="return setRole({{$team->team_id}},{{$team_user->id}},{{$role_id}})">{{$role}}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                        <li role="separator" class="divider"></li>
                                        <li>
                                            <a href="#"
                                               onclick="delMember({{$team->team_id}},{{$team_user->id}})">删除</a>
                                        </li>
                                    </ul>
                                </div>
                            @endif

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <nav class="pull-right">
                {!! $team_users->render() !!}
            </nav>
        </div>
    </div>
    <script>
        function setRole(team_id, uid, roleid){
            CGI.post({{route("manage.team.role", [])}})
            console.log(team_id,uid,roleid);
            return false;
        }
    </script>
@endsection