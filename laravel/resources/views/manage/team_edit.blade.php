@extends('layouts.manage_team')

@section('title', '新建团队')

@section('breadcrumb')
    <li><a href="{{route('manage.home')}}">返回 团队列表</a></li>
    <li>编辑团队</li>
@endsection

@section('form')
    {!!  Form::model($team , ['route' =>[ 'manage.team.store',$team->team_id], "class"=>'form-horizontal', "files"=> true])  !!}
    @include('team_form',['submitButtonText' => '保存'])
    {!! Form::close() !!}
@endsection