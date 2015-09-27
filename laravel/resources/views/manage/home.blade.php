@extends('layouts.main')

@section('title', '管理团队')

@section('content')
        <!--
    <div class="col-md-3" role="complementary">
        <div class="list-group">
            <a href="#" class="list-group-item active">
                管理团队
            </a>
            <a href="#" class="list-group-item">创建团队</a>
        </div>
    </div>
-->
<div class="col-md-9">
    <div class="panel panel-default panel-teamh">
        <div class="panel-heading">我创建的 <a class="btn btn-default btn-sm" href="{{route('manage.team.create')}}">新建一个</a></div>
        <div class="panel-body">
            @if( is_null($creaters) )
            你还没有创建团队.  <a href = "{{route('manage.team.create')}}"> 创建一个 </a>
            @else
            <table class="table table-hover table-striped">
                @foreach($creaters as $key=> $team)
                @if($key%2 == 0)
                <tr>
                @endif
                    <td> <img class="team-icon" src="{{$team['icon']}}" />
                        <a href="{{route('manage.team.edit',['team_id'=>$team['team_id']])}}"> {{$team['team_name']}} </a></td>
                @if( ($key+1)%2 == 0 || ($key+1)==count($creaters) )
                </tr>
                @endif
                @endforeach
            </table>
            @endif
            <!--
            <table class="table table-hover table-striped" >
                <tbody>
                <tr>
                    <td><img class="team-icon" src="./img/tagicon/101.png" /> 行者无疆穷游族</td>
                    <td class="operation"><span class="glyphicon glyphicon-edit"></span> 进入管理</td>
                </tr>
                <tr>
                    <td><img class="team-icon" src="./img/tagicon/102.png" /> 四喜丸子工作室</td>
                    <td class="operation"><span class="glyphicon glyphicon-edit"></span> 进入管理</td>
                </tr>
                <tr>
                    <td><img class="team-icon" src="./img/tagicon/103.png" /> 特权前端研究所</td>
                    <td class="operation"><span class="glyphicon glyphicon-edit"></span> 进入管理</td>
                </tr>
                </tbody>
            </table>
            -->
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">我管理的</h3>
        </div>
        <div class="panel-body">
            @if( is_null($managers) )
                您还没有管理的团队.
            @else
                <table class="table table-hover table-striped">
                    @foreach($managers as $key=> $team)
                        @if($key%2 == 0)
                            <tr>
                                @endif
                                <td> <img class="team-icon" src="{{$team['icon']}}" />
                                    <a href="{{route('manage.team.edit',['team_id'=>$team['team_id']])}}"> {{$team['team_name']}} </a></td>
                                @if( ($key+1)%2 == 0 || ($key+1)==count($managers) )
                            </tr>
                        @endif
                    @endforeach
                </table>
            @endif
        </div>
    </div>

    <div class="panel panel-default panel-team">
        <div class="panel-heading">
            <h3 class="panel-title">我加入的</h3>
        </div>
        <div class="panel-body">
            @if( is_null($members) && is_null($followers) )
                您还没有加入的团队.
            @else
                <table class="table table-hover table-striped">
                    @foreach($members as $key=> $team)
                        @if($key%2 == 0)
                            <tr>
                                @endif
                                <td> <img class="team-icon" src="{{$team['icon']}}" />
                                    <a href="{{route('manage.team.edit',['team_id'=>$team['team_id']])}}"> {{$team['team_name']}} </a></td>
                                @if( ($key+1)%2 == 0 || ($key+1)==count($members) )
                            </tr>
                        @endif
                    @endforeach
                </table>
                <table class="table table-hover table-striped">
                    @foreach($followers as $key=> $team)
                        @if($key%2 == 0)
                            <tr>
                                @endif
                                <td> <img class="team-icon" src="{{$team['icon']}}" />
                                    <a href="{{route('manage.team.edit',['team_id'=>$team['team_id']])}}"> {{$team['team_name']}} </a></td>
                                @if( ($key+1)%2 == 0 || ($key+1)==count($followers) )
                            </tr>
                        @endif
                    @endforeach
                </table>
            @endif
        </div>
    </div>


</div>

@endsection