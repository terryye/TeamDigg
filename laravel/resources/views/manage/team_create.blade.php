@extends('layouts.manage_team')

@section('title', '新建团队')

@section('breadcrumb')
    <li><a href="{{route('manage.home')}}">返回 团队列表</a></li>
    <li>新建团队</li>
@endsection

@section('form')
    {!!  Form::open( ['route' =>[ 'manage.team.store'], "class"=>'form-horizontal', "files"=> true])  !!}
    @include('manage.team_form',['submitButtonText' => '提交，并添加订阅源'])
    {!! Form::close() !!}
@endsection