@extends('layouts.manage_team')

@section('title', '修改团队资料')

@section('breadcrumb')
    <li><a href="{{route('manage.home')}}">返回 团队列表</a></li>
    <li>编辑团队{{$team->team_name}}</li>
@endsection

@section('form')
    {!!  Form::model($team , ['route' =>[ 'manage.team.update',$team->team_id], "class"=>'form-horizontal', "files"=> true])  !!}
    @include('manage.team_form',['submitButtonText' => '保存','team'=>$team, 'disabled'=>$disabled])
    {!! Form::close() !!}
@endsection