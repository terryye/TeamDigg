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
    <div class="panel panel-default panel-team">
        <div class="panel-heading">我创建的 <a class="btn btn-default btn-sm" href="{{route('manage.team.create')}}">新建一个</a></div>
        <div class="panel-body">
            <!--
            你还没有创建团队.  <a href = "#"> 创建一个 </a>
            -->
            <table class="table table-hover table-striped">
                <tr>
                    <td> <img class="team-icon" src="./img/tagicon/101.png" /> <a href="#"> 行者无疆穷游族 </a></td>
                    <td> <img class="team-icon" src="./img/tagicon/102.png" /> <a href="#"> 特权产品前端 </a></td>
                </tr>
                <tr>
                    <td > <img class="team-icon" src="./img/tagicon/103.png" /> <a href="#"> 行者无疆  </a></td>
                    <td > <img class="team-icon" src="./img/tagicon/1001.png" /> <a href="#"> 手Q合作开发ABC委员会 </a></td>
                </tr>
                <tr>
                    <td > <img class="team-icon" src="./img/tagicon/1002.png" /> <a href="#"> 虾米LOOP&QQ群合作 </a></td>
                    <td > </td>
                </tr>
            </table>
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
            您还没有作为管理员的团队
        </div>
    </div>

    <div class="panel panel-default panel-team">
        <div class="panel-heading">
            <h3 class="panel-title">我加入的</h3>
        </div>
        <div class="panel-body">
            <table class="table table-hover table-striped">
                <tr>
                    <td><img class="team-icon" src="./img/tagicon/101.png" /> 行者无疆穷游族</td>
                    <td><img class="team-icon" src="./img/tagicon/102.png" /> 特权产品前端</td>
                </tr>
                <tr>
                    <td ><img class="team-icon" src="./img/tagicon/103.png" /> 行者无疆</td>
                    <td ><img class="team-icon" src="./img/tagicon/1001.png" /> 手Q合作开发ABC委员会</td>
                </tr>
                <tr>
                    <td ><img class="team-icon" src="./img/tagicon/1002.png" /> 虾米LOOP&QQ群合作</td>
                    <td > </td>
                </tr>
            </table>
        </div>
    </div>


</div>

@endsection