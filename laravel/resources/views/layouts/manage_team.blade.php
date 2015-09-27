@extends('layouts.main')

@section('content')
    <div class="col-md-2" role="complementary">
        <div class="list-group">
            <a href="{{route('manage.team.edit',['team_id'=>$team_id])}}"
               class="list-group-item @if($routename == "manage.team.edit") active @endif">
                基本资料
            </a>
            <a href="{{route('manage.team.subscribe',['team_id'=>$team_id])}}"
               class="list-group-item @if($routename == "manage.team.subscribe") active @endif">
                订阅源
            </a>
            <a href="{{route('manage.team.member',['team_id'=>$team_id])}}"
               class="list-group-item @if($routename == "manage.team.member") active @endif">
                成员
            </a>
        </div>
    </div>

    <div class="col-md-7">
        <ol class="breadcrumb">
            @yield('breadcrumb')
        </ol>
        <div class="panel panel-default panel-team">
            <div class="panel-body">
                @yield('form')
                @if (isset($info))
                    <div class="alert alert-info">
                          {{ $info }}
                    </div>
                @endif
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